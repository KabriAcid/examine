# Migration Guide: React + Firebase → Laravel + MySQL + React (Inertia.js)

**Project**: Examine Quiz Application  
**Date**: November 12, 2025  
**Goal**: Migrate from React SPA with Firebase backend to Laravel + MySQL backend while preserving all React components, Tailwind design system, JavaScript functionality, and validation logic.

---

## Table of Contents
1. [Overview & Architecture Decision](#overview--architecture-decision)
2. [Prerequisites](#prerequisites)
3. [Phase 0: Preparation & Backup](#phase-0-preparation--backup)
4. [Phase 1: Install Laravel & Dependencies](#phase-1-install-laravel--dependencies)
5. [Phase 2: Configure Laravel Environment](#phase-2-configure-laravel-environment)
6. [Phase 3: Database Schema & Migrations](#phase-3-database-schema--migrations)
7. [Phase 4: API Routes & Controllers](#phase-4-api-routes--controllers)
8. [Phase 5: Integrate React + Inertia](#phase-5-integrate-react--inertia)
9. [Phase 6: Preserve Design System](#phase-6-preserve-design-system)
10. [Phase 7: Auth Migration](#phase-7-auth-migration)
11. [Phase 8: Quiz Functionality Migration](#phase-8-quiz-functionality-migration)
12. [Phase 9: Testing & Validation](#phase-9-testing--validation)
13. [Phase 10: Deployment Prep](#phase-10-deployment-prep)
14. [Reference: File Mapping](#reference-file-mapping)
15. [Reference: API Endpoints](#reference-api-endpoints)

---

## Overview & Architecture Decision

### Current Stack (examine/ folder)
- **Frontend**: React 18 + TypeScript + Vite
- **Styling**: Tailwind CSS + PostCSS + Custom fonts
- **Backend**: Firebase (Auth + Firestore)
- **State**: React Context (AuthContext, QuizContext)
- **UI Components**: Custom components + Framer Motion
- **Routing**: React Router

### Target Stack
- **Frontend**: React 18 + TypeScript + Vite (preserved)
- **Styling**: Tailwind CSS (preserved, integrated with Laravel)
- **Backend**: Laravel 10+ (PHP 8.1+)
- **Database**: MySQL 8.0+
- **Bridge**: Inertia.js (connects Laravel routes to React components)
- **Auth**: Laravel Sanctum (SPA authentication)
- **API**: RESTful JSON API + Inertia SSR

### Why Inertia.js?
- Keeps existing React components intact
- No need to build separate REST API for everything
- Server-side routing with client-side rendering
- Built-in CSRF protection
- Seamless Laravel validation integration

---

## Prerequisites

### Software Requirements
- ✅ PHP 8.1 or higher
- ✅ Composer (latest)
- ✅ Node.js 18+ and npm
- ✅ MySQL 8.0+
- ✅ Git
- ✅ XAMPP (already installed)

### Knowledge Requirements
- Laravel basics (routing, controllers, migrations)
- React and TypeScript
- Inertia.js concepts
- MySQL database design

### Verify Installations
```powershell
php -v
composer -V
node -v
npm -v
mysql --version
```

---

## Phase 0: Preparation & Backup

### Step 0.1: Commit Current State
```powershell
cd c:\xampp\htdocs\examine
git status
git add .
git commit -m "Pre-migration backup: React + Firebase version"
git tag v1.0-firebase
```

### Step 0.2: Document Current Functionality
Create a checklist of features to preserve:
- [ ] User registration with email validation
- [ ] User login/logout
- [ ] Quiz listing (all quizzes)
- [ ] Quiz details view
- [ ] Start quiz attempt
- [ ] Answer questions (MCQ, fill-blank, audio, surah-guess)
- [ ] Save progress
- [ ] Complete quiz and calculate score
- [ ] Leaderboard display
- [ ] User profile/stats
- [ ] Responsive design (mobile, tablet, desktop)
- [ ] Loading states
- [ ] Error handling
- [ ] Form validations (client-side)

### Step 0.3: Backup examine/ folder
```powershell
Copy-Item -Path "examine" -Destination "examine-backup-firebase" -Recurse
```

---

## Phase 1: Install Laravel & Dependencies

### Step 1.1: Create Laravel Project in Root
```powershell
cd c:\xampp\htdocs\examine
composer create-project laravel/laravel backend --prefer-dist
```

**Note**: This creates a `backend` folder. We'll keep `examine/` for reference and gradually migrate.

### Step 1.2: Install Laravel Packages
```powershell
cd backend
composer require inertiajs/inertia-laravel
composer require laravel/sanctum
composer require laravel/breeze --dev
```

### Step 1.3: Install Node Dependencies
```powershell
npm install
npm install @inertiajs/react react react-dom
npm install --save-dev @vitejs/plugin-react
npm install framer-motion lucide-react clsx tailwind-merge
npm install tailwindcss postcss autoprefixer
npm install -D @types/react @types/react-dom
```

### Step 1.4: Publish Inertia Middleware
```powershell
php artisan inertia:middleware
```

Add to `app/Http/Kernel.php`:
```php
'web' => [
    // ...
    \App\Http\Middleware\HandleInertiaRequests::class,
],
```

### Step 1.5: Install Sanctum
```powershell
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

---

## Phase 2: Configure Laravel Environment

### Step 2.1: Configure .env
Edit `backend/.env`:
```env
APP_NAME="Examine Quiz"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=examine_db
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=cookie
SESSION_DOMAIN=localhost
SANCTUM_STATEFUL_DOMAINS=localhost:8000,localhost:3000
```

### Step 2.2: Generate App Key
```powershell
php artisan key:generate
```

### Step 2.3: Create Database
```powershell
# Access MySQL via XAMPP
mysql -u root -p

# In MySQL prompt:
CREATE DATABASE examine_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

### Step 2.4: Configure CORS (if needed)
Edit `config/cors.php`:
```php
'paths' => ['api/*', 'sanctum/csrf-cookie'],
'supports_credentials' => true,
```

---

## Phase 3: Database Schema & Migrations

### Step 3.1: Plan Database Schema

**Tables to Create:**
1. `users` (extends Laravel default)
2. `quizzes`
3. `questions`
4. `quiz_attempts`
5. `question_answers`
6. `leaderboard` (view or table)
7. `badges`
8. `user_badges`

### Step 3.2: Create Migration Files
```powershell
php artisan make:migration create_quizzes_table
php artisan make:migration create_questions_table
php artisan make:migration create_quiz_attempts_table
php artisan make:migration create_question_answers_table
php artisan make:migration create_badges_table
php artisan make:migration create_user_badges_table
php artisan make:migration add_profile_fields_to_users_table
```

### Step 3.3: Define Migrations

**Migration: create_quizzes_table.php**
```php
public function up()
{
    Schema::create('quizzes', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description')->nullable();
        $table->integer('time_limit')->nullable()->comment('Time limit in seconds');
        $table->string('category', 100)->nullable();
        $table->enum('difficulty', ['easy', 'medium', 'hard'])->default('easy');
        $table->integer('total_points')->default(0);
        $table->integer('total_questions')->default(0);
        $table->boolean('is_active')->default(true);
        $table->string('icon')->nullable();
        $table->timestamps();
        $table->softDeletes();
    });
}
```

**Migration: create_questions_table.php**
```php
public function up()
{
    Schema::create('questions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('quiz_id')->constrained()->onDelete('cascade');
        $table->enum('type', ['mcq', 'fill-blank', 'audio', 'surah-guess'])->default('mcq');
        $table->text('question');
        $table->text('arabic_text')->nullable();
        $table->string('audio_url')->nullable();
        $table->json('choices')->nullable()->comment('Array of possible answers for MCQ');
        $table->string('correct_answer');
        $table->text('explanation')->nullable();
        $table->enum('difficulty', ['easy', 'medium', 'hard'])->default('easy');
        $table->integer('points')->default(1);
        $table->integer('order')->default(0);
        $table->timestamps();
    });
}
```

**Migration: create_quiz_attempts_table.php**
```php
public function up()
{
    Schema::create('quiz_attempts', function (Blueprint $table) {
        $table->id();
        $table->foreignId('quiz_id')->constrained()->onDelete('cascade');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->timestamp('started_at');
        $table->timestamp('completed_at')->nullable();
        $table->integer('score')->default(0);
        $table->integer('total_questions')->default(0);
        $table->integer('correct_answers')->default(0);
        $table->integer('time_spent')->nullable()->comment('Time spent in seconds');
        $table->json('answers')->nullable()->comment('User answers');
        $table->enum('status', ['in_progress', 'completed', 'abandoned'])->default('in_progress');
        $table->timestamps();
        
        $table->index(['user_id', 'quiz_id']);
    });
}
```

**Migration: create_question_answers_table.php**
```php
public function up()
{
    Schema::create('question_answers', function (Blueprint $table) {
        $table->id();
        $table->foreignId('attempt_id')->constrained('quiz_attempts')->onDelete('cascade');
        $table->foreignId('question_id')->constrained()->onDelete('cascade');
        $table->text('user_answer');
        $table->boolean('is_correct')->default(false);
        $table->integer('points_earned')->default(0);
        $table->integer('time_spent')->nullable();
        $table->timestamps();
        
        $table->unique(['attempt_id', 'question_id']);
    });
}
```

**Migration: add_profile_fields_to_users_table.php**
```php
public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('avatar')->nullable()->after('email');
        $table->integer('total_points')->default(0)->after('avatar');
        $table->integer('quizzes_completed')->default(0)->after('total_points');
        $table->timestamp('last_login_at')->nullable()->after('remember_token');
    });
}
```

### Step 3.4: Run Migrations
```powershell
php artisan migrate
```

### Step 3.5: Create Models
```powershell
php artisan make:model Quiz
php artisan make:model Question
php artisan make:model QuizAttempt
php artisan make:model QuestionAnswer
php artisan make:model Badge
```

---

## Phase 4: API Routes & Controllers

### Step 4.1: Create Controllers
```powershell
php artisan make:controller Api/AuthController
php artisan make:controller Api/QuizController
php artisan make:controller Api/AttemptController
php artisan make:controller Api/LeaderboardController
php artisan make:controller Api/UserController
```

### Step 4.2: Define API Routes
Edit `routes/api.php`:
```php
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\QuizController;
use App\Http\Controllers\Api\AttemptController;
use App\Http\Controllers\Api\LeaderboardController;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    
    // Quizzes
    Route::get('/quizzes', [QuizController::class, 'index']);
    Route::get('/quizzes/{quiz}', [QuizController::class, 'show']);
    
    // Attempts
    Route::post('/attempts', [AttemptController::class, 'store']);
    Route::put('/attempts/{attempt}', [AttemptController::class, 'update']);
    Route::post('/attempts/{attempt}/complete', [AttemptController::class, 'complete']);
    Route::get('/attempts/{attempt}', [AttemptController::class, 'show']);
    
    // Leaderboard
    Route::get('/leaderboard', [LeaderboardController::class, 'index']);
    Route::get('/leaderboard/{quiz}', [LeaderboardController::class, 'show']);
});
```

### Step 4.3: Implement AuthController
**Key methods:**
- `register()` - Create new user with validation
- `login()` - Authenticate and return token/session
- `logout()` - Revoke token
- `user()` - Return authenticated user

### Step 4.4: Implement QuizController
**Key methods:**
- `index()` - List all active quizzes
- `show($id)` - Get quiz with questions
- `store()` - Create quiz (admin)
- `update()` - Update quiz (admin)

### Step 4.5: Implement AttemptController
**Key methods:**
- `store()` - Start new quiz attempt
- `update()` - Save answer to question
- `complete()` - Finish attempt and calculate score
- `show()` - Get attempt details

---

## Phase 5: Integrate React + Inertia

### Step 5.1: Configure Vite for Inertia + React
Edit `backend/vite.config.js`:
```js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.tsx'],
            refresh: true,
        }),
        react(),
    ],
    resolve: {
        alias: {
            '@': '/resources/js',
        },
    },
});
```

### Step 5.2: Create Inertia App Entry Point
Create `backend/resources/js/app.tsx`:
```tsx
import './bootstrap';
import '../css/app.css';

import { createRoot } from 'react-dom/client';
import { createInertiaApp } from '@inertiajs/react';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Examine';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.tsx`, import.meta.glob('./Pages/**/*.tsx')),
    setup({ el, App, props }) {
        const root = createRoot(el);
        root.render(<App {...props} />);
    },
    progress: {
        color: '#4B5563',
    },
});
```

### Step 5.3: Create Base Layout
Create `backend/resources/js/Layouts/AppLayout.tsx`:
```tsx
import React, { ReactNode } from 'react';
import { Link } from '@inertiajs/react';
import Navbar from '@/Components/Navbar';
import Footer from '@/Components/Footer';

interface Props {
    children: ReactNode;
}

export default function AppLayout({ children }: Props) {
    return (
        <div className="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50">
            <Navbar />
            <main>{children}</main>
            <Footer />
        </div>
    );
}
```

### Step 5.4: Move React Components
```powershell
# Create directories
New-Item -ItemType Directory -Path "backend\resources\js\Pages"
New-Item -ItemType Directory -Path "backend\resources\js\Components"
New-Item -ItemType Directory -Path "backend\resources\js\Components\ui"
New-Item -ItemType Directory -Path "backend\resources\js\Layouts"
New-Item -ItemType Directory -Path "backend\resources\js\lib"
New-Item -ItemType Directory -Path "backend\resources\js\types"
New-Item -ItemType Directory -Path "backend\resources\js\hooks"

# Copy components
Copy-Item -Path "examine\src\components\*" -Destination "backend\resources\js\Components" -Recurse
Copy-Item -Path "examine\src\pages\*" -Destination "backend\resources\js\Pages" -Recurse
Copy-Item -Path "examine\src\lib\*" -Destination "backend\resources\js\lib" -Recurse
Copy-Item -Path "examine\src\types\*" -Destination "backend\resources\js\types" -Recurse
```

### Step 5.5: Update Imports
Replace all imports in copied files:
- `import { BrowserRouter, Routes, Route }` → Use Inertia Link/router
- Firebase imports → Remove, use Inertia/axios
- Relative imports `../components` → `@/Components`

---

## Phase 6: Preserve Design System

### Step 6.1: Copy Tailwind Config
```powershell
Copy-Item -Path "examine\tailwind.config.js" -Destination "backend\tailwind.config.js"
Copy-Item -Path "examine\postcss.config.js" -Destination "backend\postcss.config.js"
```

### Step 6.2: Update Tailwind Config
Edit `backend/tailwind.config.js`:
```js
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.tsx',
        './resources/js/**/*.ts',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', 'sans-serif'],
                arabic: ['Amiri', 'serif'],
            },
            // Copy custom colors, animations from examine/tailwind.config.js
        },
    },
    plugins: [],
};
```

### Step 6.3: Copy CSS and Fonts
```powershell
# Copy CSS
Copy-Item -Path "examine\src\index.css" -Destination "backend\resources\css\app.css"

# Copy fonts
New-Item -ItemType Directory -Path "backend\public\assets\fonts" -Force
Copy-Item -Path "examine\src\assets\fonts\*" -Destination "backend\public\assets\fonts" -Recurse
```

### Step 6.4: Update Font Paths
Edit `backend/resources/css/app.css` - update `@font-face` paths:
```css
@font-face {
    font-family: 'YourFont';
    src: url('/assets/fonts/YourFont.woff2') format('woff2');
}
```

---

## Phase 7: Auth Migration

### Step 7.1: Map Firebase Auth to Laravel Sanctum

**Firebase (examine/src/services/auth.ts) → Laravel**

| Firebase Method | Laravel Equivalent |
|----------------|-------------------|
| `createUserWithEmailAndPassword()` | `POST /api/register` |
| `signInWithEmailAndPassword()` | `POST /api/login` |
| `signOut()` | `POST /api/logout` |
| `onAuthStateChanged()` | `GET /api/user` (polling or on mount) |

### Step 7.2: Update AuthContext
Create `backend/resources/js/contexts/AuthContext.tsx`:
```tsx
import React, { createContext, useContext, useState, useEffect } from 'react';
import axios from 'axios';

interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    total_points: number;
    quizzes_completed: number;
}

interface AuthContextType {
    user: User | null;
    login: (email: string, password: string) => Promise<void>;
    register: (name: string, email: string, password: string) => Promise<void>;
    logout: () => Promise<void>;
    loading: boolean;
}

const AuthContext = createContext<AuthContextType | undefined>(undefined);

export function AuthProvider({ children }: { children: React.ReactNode }) {
    const [user, setUser] = useState<User | null>(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        checkAuth();
    }, []);

    const checkAuth = async () => {
        try {
            const { data } = await axios.get('/api/user');
            setUser(data);
        } catch (error) {
            setUser(null);
        } finally {
            setLoading(false);
        }
    };

    const login = async (email: string, password: string) => {
        await axios.get('/sanctum/csrf-cookie');
        const { data } = await axios.post('/api/login', { email, password });
        setUser(data.user);
    };

    const register = async (name: string, email: string, password: string, password_confirmation: string) => {
        await axios.get('/sanctum/csrf-cookie');
        const { data } = await axios.post('/api/register', { name, email, password, password_confirmation });
        setUser(data.user);
    };

    const logout = async () => {
        await axios.post('/api/logout');
        setUser(null);
    };

    return (
        <AuthContext.Provider value={{ user, login, register, logout, loading }}>
            {children}
        </AuthContext.Provider>
    );
}

export const useAuth = () => {
    const context = useContext(AuthContext);
    if (!context) throw new Error('useAuth must be used within AuthProvider');
    return context;
};
```

### Step 7.3: Update Login/Register Pages
Update imports and replace Firebase calls with context methods:
```tsx
// In Login.tsx
const { login } = useAuth();

const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    try {
        await login(email, password);
        // Inertia will handle redirect
    } catch (error) {
        setError(error.response?.data?.message);
    }
};
```

---

## Phase 8: Quiz Functionality Migration

### Step 8.1: Map Firestore Methods to Laravel API

| Firestore Operation | Laravel API |
|-------------------|-------------|
| `collection('quizzes').get()` | `GET /api/quizzes` |
| `doc('quizzes', id).get()` | `GET /api/quizzes/{id}` |
| `collection('attempts').add()` | `POST /api/attempts` |
| `doc('attempts', id).update()` | `PUT /api/attempts/{id}` |
| `onSnapshot()` | Replace with polling or remove |

### Step 8.2: Update QuizContext
Create `backend/resources/js/contexts/QuizContext.tsx`:
```tsx
import React, { createContext, useContext, useState } from 'react';
import axios from 'axios';
import { Quiz, Question, QuizAttempt } from '@/types';

interface QuizContextType {
    quizzes: Quiz[];
    currentQuiz: Quiz | null;
    currentAttempt: QuizAttempt | null;
    loadQuizzes: () => Promise<void>;
    startQuiz: (quizId: number) => Promise<void>;
    submitAnswer: (questionId: number, answer: string) => Promise<void>;
    completeQuiz: () => Promise<void>;
}

const QuizContext = createContext<QuizContextType | undefined>(undefined);

export function QuizProvider({ children }: { children: React.ReactNode }) {
    const [quizzes, setQuizzes] = useState<Quiz[]>([]);
    const [currentQuiz, setCurrentQuiz] = useState<Quiz | null>(null);
    const [currentAttempt, setCurrentAttempt] = useState<QuizAttempt | null>(null);

    const loadQuizzes = async () => {
        const { data } = await axios.get('/api/quizzes');
        setQuizzes(data);
    };

    const startQuiz = async (quizId: number) => {
        const { data: quiz } = await axios.get(`/api/quizzes/${quizId}`);
        setCurrentQuiz(quiz);
        
        const { data: attempt } = await axios.post('/api/attempts', { quiz_id: quizId });
        setCurrentAttempt(attempt);
    };

    const submitAnswer = async (questionId: number, answer: string) => {
        if (!currentAttempt) return;
        
        await axios.put(`/api/attempts/${currentAttempt.id}`, {
            question_id: questionId,
            answer,
        });
    };

    const completeQuiz = async () => {
        if (!currentAttempt) return;
        
        const { data } = await axios.post(`/api/attempts/${currentAttempt.id}/complete`);
        setCurrentAttempt(data);
    };

    return (
        <QuizContext.Provider value={{ 
            quizzes, 
            currentQuiz, 
            currentAttempt,
            loadQuizzes, 
            startQuiz, 
            submitAnswer, 
            completeQuiz 
        }}>
            {children}
        </QuizContext.Provider>
    );
}

export const useQuiz = () => {
    const context = useContext(QuizContext);
    if (!context) throw new Error('useQuiz must be used within QuizProvider');
    return context;
};
```

### Step 8.3: Update Quiz Pages
Update all quiz-related pages to use new context and remove Firebase dependencies.

---

## Phase 9: Testing & Validation

### Step 9.1: Preserve Client-Side Validation
Keep all validation logic in React components (Register.tsx, Login.tsx, Quiz.tsx).

### Step 9.2: Add Server-Side Validation
Create FormRequests:
```powershell
php artisan make:request RegisterRequest
php artisan make:request LoginRequest
php artisan make:request SubmitAnswerRequest
```

### Step 9.3: Test All Features
**Manual Testing Checklist:**
- [ ] Register new user
- [ ] Login with valid credentials
- [ ] Login with invalid credentials (test errors)
- [ ] View all quizzes
- [ ] Start quiz
- [ ] Answer questions (all types)
- [ ] Submit answers
- [ ] Complete quiz
- [ ] View score
- [ ] View leaderboard
- [ ] Logout
- [ ] Protected routes redirect to login
- [ ] Form validations display properly
- [ ] Loading states work
- [ ] Responsive design intact

### Step 9.4: Create Seeders
```powershell
php artisan make:seeder QuizSeeder
php artisan make:seeder QuestionSeeder
php artisan db:seed
```

---

## Phase 10: Deployment Prep

### Step 10.1: Build for Production
```powershell
npm run build
```

### Step 10.2: Optimize Laravel
```powershell
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Step 10.3: Environment Configuration
Update `.env` for production:
```env
APP_ENV=production
APP_DEBUG=false
```

### Step 10.4: Database Backup Strategy
Set up regular backups and migration rollback plan.

---

## Reference: File Mapping

### React Components (examine/src → backend/resources/js)
```
examine/src/pages/Home.tsx → backend/resources/js/Pages/Home.tsx
examine/src/pages/Login.tsx → backend/resources/js/Pages/Login.tsx
examine/src/pages/Register.tsx → backend/resources/js/Pages/Register.tsx
examine/src/pages/Quiz.tsx → backend/resources/js/Pages/Quiz.tsx

examine/src/components/Navbar.tsx → backend/resources/js/Components/Navbar.tsx
examine/src/components/Footer.tsx → backend/resources/js/Components/Footer.tsx
examine/src/components/QuizCard.tsx → backend/resources/js/Components/QuizCard.tsx
examine/src/components/ScoreBoard.tsx → backend/resources/js/Components/ScoreBoard.tsx

examine/src/components/ui/* → backend/resources/js/Components/ui/*
```

### Services Migration (Firebase → Laravel API)
```
examine/src/services/auth.ts → Laravel AuthController + useAuth hook
examine/src/services/database.ts → Laravel QuizController + AttemptController + useQuiz hook
examine/auth.js → Deprecated (Firebase Admin)
examine/database.js → Deprecated (Firebase Admin)
```

### Config Files
```
examine/tailwind.config.js → backend/tailwind.config.js
examine/postcss.config.js → backend/postcss.config.js
examine/vite.config.js → backend/vite.config.js (modified for Laravel)
examine/tsconfig.json → backend/tsconfig.json
```

---

## Reference: API Endpoints

### Authentication
- `POST /api/register` - Register new user
- `POST /api/login` - Login user
- `POST /api/logout` - Logout user
- `GET /api/user` - Get authenticated user

### Quizzes
- `GET /api/quizzes` - List all quizzes
- `GET /api/quizzes/{id}` - Get quiz details with questions
- `POST /api/quizzes` - Create quiz (admin)
- `PUT /api/quizzes/{id}` - Update quiz (admin)
- `DELETE /api/quizzes/{id}` - Delete quiz (admin)

### Quiz Attempts
- `POST /api/attempts` - Start new quiz attempt
- `GET /api/attempts/{id}` - Get attempt details
- `PUT /api/attempts/{id}` - Save answer to question
- `POST /api/attempts/{id}/complete` - Complete quiz and calculate score

### Leaderboard
- `GET /api/leaderboard` - Get global leaderboard
- `GET /api/leaderboard/{quiz}` - Get quiz-specific leaderboard

### User Profile
- `GET /api/profile` - Get user profile and stats
- `PUT /api/profile` - Update user profile
- `GET /api/profile/attempts` - Get user's quiz history

---

## Success Criteria

✅ All React components render correctly  
✅ Tailwind styles applied properly  
✅ User can register and login  
✅ Quizzes load and display  
✅ Quiz flow works (start → answer → complete → score)  
✅ Leaderboard displays correct data  
✅ All validations work (client + server)  
✅ No Firebase dependencies remain  
✅ Responsive design preserved  
✅ Loading states and error handling intact  

---

## Troubleshooting

### Common Issues

**Vite not building:**
- Check `vite.config.js` syntax
- Ensure React plugin installed
- Clear `node_modules` and reinstall

**Inertia not loading pages:**
- Check middleware registered
- Verify `app.tsx` setup
- Check browser console for errors

**CORS errors:**
- Configure `config/cors.php`
- Set `SANCTUM_STATEFUL_DOMAINS` in `.env`

**Database connection failed:**
- Verify MySQL running (XAMPP)
- Check `.env` credentials
- Ensure database exists

**CSS not loading:**
- Run `npm run dev`
- Check Vite manifest
- Verify `@vite` directives in blade

---

## Next Steps After Migration

1. **Performance Optimization**
   - Implement caching (Redis)
   - Optimize database queries
   - Add indexes

2. **Additional Features**
   - Admin panel for quiz management
   - Real-time leaderboard (Laravel Echo + Pusher)
   - Email notifications
   - Social auth (OAuth)

3. **Testing**
   - Write PHPUnit tests for API
   - Add React Testing Library tests
   - E2E tests with Cypress

4. **DevOps**
   - Set up CI/CD pipeline
   - Docker containerization
   - Deploy to production server

---

**End of Migration Guide**
