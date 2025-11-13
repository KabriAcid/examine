# 🎯 Examine: Duolingo-Inspired Gamified Learning Platform for JAMB/WAEC

**Project**: Examine - The Fun Way to Master Nigerian Exams  
**Date**: November 13, 2025  
**Vision**: Transform exam preparation into an addictive, joyful learning experience  
**Inspiration**: Duolingo's gamification + Premium polish + Mobile-first design

**Tech Stack**: Laravel 11 + Livewire 3 + Alpine.js + MySQL + AI-Powered Questions

---

## 🌟 Core Philosophy: Learning Should Be Fun & Addictive

**What Makes Duolingo Work:**
- ✨ Bite-sized lessons (5-10 minutes)
- 🏆 Streaks & XP points for daily engagement
- 💎 Hearts system (lives) for stakes
- 🎯 Clear progression with levels
- 🎨 Friendly, colorful, animated UI
- 📱 Mobile-first, thumb-friendly design
- 💪 Leagues & leaderboards for competition
- 🎁 Achievements & badges for motivation
- 💰 Premium tier with exclusive benefits

**Our Adaptation for JAMB/WAEC:**
- 📚 Quick practice sessions (10 questions = 1 lesson)
- 🔥 Daily streaks to build study habits
- ❤️ Hearts system (5 hearts, lose 1 per wrong answer)
- ⭐ XP points per correct answer (10-50 XP based on difficulty)
- 📊 Subject-based progression trees (unlock topics)
- 🎯 Difficulty levels: Beginner → Intermediate → Advanced → Expert
- 🏅 Weekly leagues (Bronze → Silver → Gold → Diamond)
- 🎖️ Achievements (First win, 7-day streak, Perfect score, etc.)
- 👑 Examine Premium (unlimited hearts, no ads, streak freeze)

---

## 📱 Table of Contents

### Part A: Vision & Design Philosophy

1. [Core Experience: The Student Journey](#core-experience-the-student-journey)
2. [Gamification System Design](#gamification-system-design)
3. [Mobile-First UI/UX Principles](#mobile-first-uiux-principles)
4. [Premium Features & Monetization](#premium-features--monetization)

### Part B: Technical Architecture

5. [Database Schema for Gamification](#database-schema-for-gamification)
6. [Component Library (Mobile-First)](#component-library-mobile-first)
7. [Animation System (Alpine.js + Tailwind)](#animation-system)
8. [AI Question Generation](#ai-question-generation)
9. [Real-time Features (Livewire)](#real-time-features)
10. [Payment Integration (Paystack)](#payment-integration)

### Part C: Implementation Roadmap

11. [Phase 1: Core Learning Experience](#phase-1-core-learning-experience)
12. [Phase 2: Gamification Layer](#phase-2-gamification-layer)
13. [Phase 3: Social Features](#phase-3-social-features)
14. [Phase 4: Premium Features](#phase-4-premium-features)
15. [Phase 5: Mobile App (PWA)](#phase-5-mobile-app-pwa)

### Part D: Design System & Components

16. [Color Psychology & Theming](#color-psychology--theming)
17. [Typography & Readability](#typography--readability)
18. [Iconography & Illustrations](#iconography--illustrations)
19. [Micro-interactions & Animations](#micro-interactions--animations)
20. [Sound Effects & Haptics](#sound-effects--haptics)

---

## 🎮 Core Experience: The Student Journey

### First-Time User Flow (Onboarding)

1. **Warm Welcome Screen** (Full-screen gradient animation)
   - Animated logo reveal
   - "Welcome to Examine! 👋"
   - "Let's make exam prep fun!"
   - Single CTA: "Get Started"

2. **Quick Profile Setup** (One field per screen, mobile-optimized)
   - Name input with friendly placeholder
   - Email with animated validation
   - Password with strength indicator
   - Optional: Profile avatar selection (fun icons)

3. **Goal Selection** (Card-based, tap to select)
   - "What exam are you preparing for?"
   - JAMB | WAEC | NECO | Just Practice
   - Each with icon and brief description

4. **Subject Selection** (Grid layout, multi-select)
   - "Pick your subjects" (4 for JAMB, flexible for others)
   - Visual cards with subject icons
   - Progress indicator (e.g., "2 of 4 selected")

5. **Placement Test** (Optional, gamified)
   - "Let's see your current level!"
   - 5 quick MCQ questions per subject
   - Friendly feedback: "Great start!" or "Let's learn together!"
   - Algorithm places student in appropriate difficulty tier

6. **Dashboard Intro** (Animated tour)
   - "This is your XP bar! 📊"
   - "Here's your streak! 🔥"
   - "Your hearts ❤️❤️❤️❤️❤️"
   - "Tap here to start learning!"

### Daily Learning Flow

**Home Dashboard (Mobile-First Layout):**

```
┌─────────────────────────────┐
│  👋 Hi, Ahmed!              │
│  🔥 7 Day Streak            │
│  ⭐ 2,450 XP                │
├─────────────────────────────┤
│  TODAY'S GOAL: 50 XP        │
│  [████████░░] 80%           │
├─────────────────────────────┤
│  ❤️ ❤️ ❤️ ❤️ ❤️            │
│  5 Hearts remaining         │
├─────────────────────────────┤
│  SUBJECTS                   │
│  ┌──────┬──────┬──────┐    │
│  │ Math │ Eng  │ Phy  │    │
│  │ 🎯 5 │ ⭐ 3 │ 🔒 0 │    │
│  └──────┴──────┴──────┘    │
├─────────────────────────────┤
│  QUICK PRACTICE             │
│  [ Start 10-Question Set ]  │
├─────────────────────────────┤
│  ACHIEVEMENTS 🏆            │
│  [ View Badges ]            │
└─────────────────────────────┘
```

### Lesson Experience (MCQ Practice)

1. **Lesson Intro Screen**
   - Subject icon + name
   - "10 Questions • ~5 minutes"
   - "+10 XP per correct answer"
   - Animated "Start" button with pulse effect

2. **Question Screen** (One question fills entire mobile viewport)
   ```
   ┌─────────────────────────────┐
   │ [×] Mathematics        ❤️ 5 │
   │ Question 3 of 10            │
   │ [████████░░░░░] 30%         │
   ├─────────────────────────────┤
   │                             │
   │  What is the value of       │
   │  2x + 5 when x = 3?         │
   │                             │
   │  ┌───────────────────────┐  │
   │  │   A. 8                │  │
   │  └───────────────────────┘  │
   │  ┌───────────────────────┐  │
   │  │   B. 11              │  │
   │  └───────────────────────┘  │
   │  ┌───────────────────────┐  │
   │  │   C. 13              │  │
   │  └───────────────────────┘  │
   │  ┌───────────────────────┐  │
   │  │   D. 16              │  │
   │  └───────────────────────┘  │
   │                             │
   │         [ CHECK ]           │
   └─────────────────────────────┘
   ```

3. **Immediate Feedback** (Full-screen overlay)
   - ✅ **Correct**: Green confetti animation + "+10 XP" bouncing text
   - ❌ **Wrong**: Red screen shake + heart loss animation + explanation
   - Button: "Continue" with haptic feedback

4. **Lesson Complete** (Celebration screen)
   - Animated trophy/star burst
   - "+80 XP" with counter animation
   - "Great job! 8/10 correct 🎉"
   - Subject progress bar update animation
   - Buttons: "Review Mistakes" | "Next Lesson"

### Tech Stack (Optimized for Mobile)

- **Frontend**: Laravel 11 + Livewire 3 + Alpine.js (SPA-like feel)
- **Styling**: Tailwind CSS (mobile-first) + Custom animations
- **Database**: MySQL 8.0 (optimized queries for fast mobile response)
- **Real-time**: Livewire polling (for XP updates, streak tracking)
- **Caching**: Redis (for leaderboards, user stats)
- **PWA**: Workbox (offline support, add to home screen)
- **Icons**: Lucide Icons + Custom SVG illustrations
- **Animations**: Alpine.js transitions + Tailwind animations + CSS keyframes
- **Fonts**: Ginto (primary) + System fonts (fallback for speed)
- **AI**: OpenAI GPT-4.1 API integration
- **Animations**: Alpine.js + Tailwind transitions (replacing Framer Motion)

### Why Livewire Instead of Inertia?

**For this CBT platform, Livewire is better because:**

1. **Real-time updates**: Auto-save, timers, and state management are simpler with Livewire's reactive properties
2. **Less complexity**: No need for API layer between frontend and backend
3. **Built-in form handling**: Perfect for admin panels and student forms
4. **Polling support**: Native support for auto-save every 10 seconds
5. **Smaller learning curve**: Easier to maintain for future developers
6. **Better for admin dashboards**: Rich data tables, filters, and CRUD operations
7. **Shared hosting friendly**: Less JavaScript bundling, faster load times

### Migration Strategy

**Phase A: Technical Migration (React → Laravel + Livewire)**

- Convert React components to Livewire components
- Replace Firebase Auth with Laravel Authentication
- Migrate Firestore data structure to MySQL
- Convert React Router to Laravel routes
- Replace Framer Motion with Alpine.js animations
- Keep Tailwind CSS configuration

**Phase B: Feature Transformation (Quiz App → CBT Platform)**

- Add school management system
- Implement multi-role authentication
- Build AI question generation module
- Create exam interface with advanced features
- Add subscription & payment system
- Build comprehensive admin dashboards

---

## Feature Comparison

### Feature Mapping: Quran Quiz → JAMB/WAEC CBT

| Quran Quiz Feature | JAMB/WAEC Equivalent        | Changes Required                                     |
| ------------------ | --------------------------- | ---------------------------------------------------- |
| User registration  | Student registration        | Add school_id, bulk CSV upload                       |
| Single quiz type   | Multiple exam types         | Add exam templates (JAMB/WAEC/NECO)                  |
| Firebase Auth      | Laravel Auth                | Multi-role system (Super Admin/School Admin/Student) |
| Simple timer       | Dual timer system           | Global 2hr + 30min per subject                       |
| Single leaderboard | School-specific leaderboard | Per-school isolation                                 |
| Manual questions   | AI + Manual questions       | Integrate GPT-4.1 API                                |
| Basic MCQ          | Advanced MCQ (4-5 options)  | Support A-E options                                  |
| Free access        | Subscription-based          | Add Paystack/Flutterwave                             |
| Instant start      | Scheduled exams             | Add exam scheduling                                  |
| Single context     | Multi-school context        | Add school isolation                                 |
| Basic result page  | Comprehensive analytics     | Charts, subject breakdown, review                    |

### Components to Preserve from React App

**UI Components (Convert to Livewire):**

- ✅ Button.tsx → Button Blade component
- ✅ Input.tsx → Input Blade component
- ✅ Modal.tsx → Livewire Modal component
- ✅ Loader.tsx → Livewire loading states
- ✅ Navbar.tsx → Blade layout with Alpine.js
- ✅ Footer.tsx → Blade partial
- ✅ QuizCard.tsx → ExamCard Livewire component
- ✅ ScoreBoard.tsx → ResultCard Livewire component

**Design Elements to Preserve:**

- ✅ Tailwind configuration (colors, fonts, spacing)
- ✅ Arabic font support (for multilingual questions)
- ✅ Gradient backgrounds
- ✅ Card-based layouts
- ✅ Responsive breakpoints
- ✅ Animation patterns (convert to Alpine.js)
- ✅ Color scheme and theming

**Business Logic to Adapt:**

- Quiz flow → Exam session management
- Answer tracking → Multi-subject answer storage
- Score calculation → Advanced grading system
- Timer logic → Dual timer system
- User context → Multi-role context

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

### Step 3.1: Plan Database Schema for CBT Platform

**Core Tables:**

1. `users` - All users (Super Admin, School Admin, Students)
2. `schools` - Registered institutions
3. `subscriptions` - School billing & plans
4. `students` - Student-specific data
5. `subjects` - Subject master list
6. `exams` - Exam templates
7. `exam_schedules` - Scheduled exam sessions
8. `questions` - Question bank
9. `exam_questions` - Question mapping per exam
10. `exam_attempts` - Student exam sessions
11. `student_answers` - Individual answers
12. `ai_prompts` - GPT prompt logs
13. `payments` - Transaction records

**Schema Design Principles:**

- Each school is isolated (school_id foreign key)
- Soft deletes for all major tables
- Timestamps for audit trail
- JSON columns for flexible data (answers, options)
- Indexes on frequently queried columns

### Step 3.2: Create Migration Files

```powershell
# Core system tables
php artisan make:migration create_schools_table
php artisan make:migration create_subscriptions_table
php artisan make:migration create_students_table
php artisan make:migration add_role_and_school_to_users_table

# Exam system tables
php artisan make:migration create_subjects_table
php artisan make:migration create_exams_table
php artisan make:migration create_exam_schedules_table
php artisan make:migration create_questions_table
php artisan make:migration create_exam_questions_table

# Attempt and answer tables
php artisan make:migration create_exam_attempts_table
php artisan make:migration create_student_answers_table

# AI and payment tables
php artisan make:migration create_ai_prompts_table
php artisan make:migration create_payments_table
```

### Step 3.3: Define Migrations for CBT Platform

**Migration: create_schools_table.php**

```php
public function up()
{
    Schema::create('schools', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('code')->unique()->comment('Unique school identifier');
        $table->string('email')->unique();
        $table->string('phone');
        $table->text('address')->nullable();
        $table->string('logo')->nullable();
        $table->enum('status', ['active', 'suspended', 'expired'])->default('active');
        $table->integer('max_students')->default(50)->comment('Based on subscription');
        $table->integer('current_students')->default(0);
        $table->timestamps();
        $table->softDeletes();

        $table->index('code');
        $table->index('status');
    });
}
```

**Migration: create_subscriptions_table.php**

```php
public function up()
{
    Schema::create('subscriptions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('school_id')->constrained()->onDelete('cascade');
        $table->enum('plan', ['basic_50', 'standard_200', 'premium_500', 'enterprise_1000']);
        $table->integer('student_limit');
        $table->decimal('amount', 10, 2);
        $table->date('start_date');
        $table->date('end_date');
        $table->enum('status', ['active', 'expired', 'cancelled'])->default('active');
        $table->string('payment_reference')->nullable();
        $table->timestamps();

        $table->index(['school_id', 'status']);
    });
}
```

**Migration: create_students_table.php**

```php
public function up()
{
    Schema::create('students', function (Blueprint $table) {
        $table->id();
        $table->foreignId('school_id')->constrained()->onDelete('cascade');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('student_id')->unique()->comment('School-specific student ID');
        $table->string('full_name');
        $table->string('class')->nullable();
        $table->string('department')->nullable();
        $table->string('exam_type')->nullable()->comment('JAMB, WAEC, NECO');
        $table->json('selected_subjects')->nullable()->comment('4 subjects array');
        $table->integer('total_exams_taken')->default(0);
        $table->decimal('average_score', 5, 2)->default(0);
        $table->timestamps();
        $table->softDeletes();

        $table->index(['school_id', 'student_id']);
    });
}
```

**Migration: create_subjects_table.php**

```php
public function up()
{
    Schema::create('subjects', function (Blueprint $table) {
        $table->id();
        $table->string('name')->unique();
        $table->string('code', 10)->unique();
        $table->text('description')->nullable();
        $table->enum('category', ['science', 'arts', 'commercial', 'general'])->default('general');
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}
```

**Migration: create_exams_table.php**

```php
public function up()
{
    Schema::create('exams', function (Blueprint $table) {
        $table->id();
        $table->foreignId('school_id')->constrained()->onDelete('cascade');
        $table->string('title');
        $table->text('description')->nullable();
        $table->enum('exam_type', ['jamb', 'waec', 'neco', 'custom'])->default('jamb');
        $table->integer('duration_minutes')->default(120)->comment('Total exam time');
        $table->integer('subject_duration_minutes')->default(30);
        $table->integer('questions_per_subject')->default(40);
        $table->integer('total_marks')->default(400)->comment('100 per subject');
        $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
        $table->timestamps();
        $table->softDeletes();

        $table->index(['school_id', 'status']);
    });
}
```

**Migration: create_questions_table.php**

```php
public function up()
{
    Schema::create('questions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('school_id')->constrained()->onDelete('cascade');
        $table->foreignId('subject_id')->constrained()->onDelete('cascade');
        $table->text('question');
        $table->json('options')->comment('JSON: {A: "", B: "", C: "", D: "", E: ""}');
        $table->char('correct_answer', 1)->comment('A, B, C, D, or E');
        $table->text('explanation')->nullable();
        $table->string('topic')->nullable();
        $table->enum('difficulty', ['easy', 'medium', 'hard'])->default('medium');
        $table->enum('source', ['ai_generated', 'manual', 'csv_upload'])->default('manual');
        $table->string('ai_prompt_id')->nullable()->comment('Reference to AI prompt if generated');
        $table->integer('usage_count')->default(0)->comment('Times used in exams');
        $table->timestamps();
        $table->softDeletes();

        $table->index(['school_id', 'subject_id']);
        $table->index('source');
    });
}
```

**Migration: create_exam_schedules_table.php**

```php
public function up()
{
    Schema::create('exam_schedules', function (Blueprint $table) {
        $table->id();
        $table->foreignId('exam_id')->constrained()->onDelete('cascade');
        $table->json('subject_ids')->comment('Array of 4 subject IDs');
        $table->dateTime('start_date');
        $table->dateTime('end_date');
        $table->boolean('is_active')->default(true);
        $table->text('instructions')->nullable();
        $table->timestamps();

        $table->index(['exam_id', 'is_active']);
    });
}
```

**Migration: create_exam_questions_table.php**

```php
public function up()
{
    Schema::create('exam_questions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('exam_schedule_id')->constrained()->onDelete('cascade');
        $table->foreignId('question_id')->constrained()->onDelete('cascade');
        $table->foreignId('subject_id')->constrained();
        $table->integer('order')->default(0);
        $table->timestamps();

        $table->unique(['exam_schedule_id', 'question_id']);
        $table->index('subject_id');
    });
}
```

**Migration: create_exam_attempts_table.php**

```php
public function up()
{
    Schema::create('exam_attempts', function (Blueprint $table) {
        $table->id();
        $table->foreignId('student_id')->constrained()->onDelete('cascade');
        $table->foreignId('exam_schedule_id')->constrained()->onDelete('cascade');
        $table->timestamp('started_at');
        $table->timestamp('completed_at')->nullable();
        $table->integer('time_spent')->nullable()->comment('Seconds');
        $table->json('subject_timers')->nullable()->comment('Time spent per subject');
        $table->integer('total_score')->default(0);
        $table->decimal('percentage', 5, 2)->default(0);
        $table->json('subject_scores')->nullable()->comment('Score breakdown per subject');
        $table->enum('status', ['in_progress', 'completed', 'auto_submitted', 'abandoned'])->default('in_progress');
        $table->timestamps();

        $table->index(['student_id', 'status']);
        $table->index('exam_schedule_id');
    });
}
```

**Migration: create_student_answers_table.php**

```php
public function up()
{
    Schema::create('student_answers', function (Blueprint $table) {
        $table->id();
        $table->foreignId('exam_attempt_id')->constrained()->onDelete('cascade');
        $table->foreignId('question_id')->constrained()->onDelete('cascade');
        $table->foreignId('subject_id')->constrained();
        $table->char('selected_answer', 1)->nullable()->comment('A, B, C, D, or E');
        $table->boolean('is_correct')->default(false);
        $table->boolean('is_flagged')->default(false);
        $table->integer('time_spent')->nullable();
        $table->timestamps();

        $table->unique(['exam_attempt_id', 'question_id']);
        $table->index('subject_id');
    });
}
```

**Migration: create_ai_prompts_table.php**

```php
public function up()
{
    Schema::create('ai_prompts', function (Blueprint $table) {
        $table->id();
        $table->foreignId('school_id')->constrained()->onDelete('cascade');
        $table->foreignId('subject_id')->constrained();
        $table->text('prompt');
        $table->json('parameters')->comment('difficulty, topic, question_count, etc.');
        $table->json('response')->nullable()->comment('Full GPT response');
        $table->integer('questions_generated')->default(0);
        $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
        $table->text('error_message')->nullable();
        $table->timestamps();

        $table->index(['school_id', 'status']);
    });
}
```

**Migration: create_payments_table.php**

```php
public function up()
{
    Schema::create('payments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('school_id')->constrained()->onDelete('cascade');
        $table->string('reference')->unique();
        $table->decimal('amount', 10, 2);
        $table->enum('payment_method', ['paystack', 'flutterwave', 'bank_transfer'])->default('paystack');
        $table->enum('status', ['pending', 'successful', 'failed', 'cancelled'])->default('pending');
        $table->json('meta')->nullable()->comment('Gateway response data');
        $table->string('plan_type')->nullable();
        $table->timestamps();

        $table->index(['school_id', 'status']);
        $table->index('reference');
    });
}
```

**Migration: add_role_and_school_to_users_table.php**

```php
public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->enum('role', ['super_admin', 'school_admin', 'student'])->default('student')->after('email');
        $table->foreignId('school_id')->nullable()->constrained()->onDelete('cascade')->after('role');
        $table->timestamp('last_login_at')->nullable()->after('remember_token');
        $table->boolean('is_active')->default(true)->after('last_login_at');

        $table->index(['school_id', 'role']);
    });
}
```

### Step 3.4: Run Migrations

```powershell
php artisan migrate
```

### Step 3.5: Create Models with Relationships

```powershell
php artisan make:model School
php artisan make:model Subscription
php artisan make:model Student
php artisan make:model Subject
php artisan make:model Exam
php artisan make:model ExamSchedule
php artisan make:model Question
php artisan make:model ExamQuestion
php artisan make:model ExamAttempt
php artisan make:model StudentAnswer
php artisan make:model AiPrompt
php artisan make:model Payment
```

**Key Model Relationships:**

- School hasMany Students, Exams, Questions, Subscriptions
- Student belongsTo School, User; hasMany ExamAttempts
- Exam belongsTo School; hasMany ExamSchedules
- ExamSchedule hasMany ExamAttempts, ExamQuestions
- Question belongsTo School, Subject
- ExamAttempt belongsTo Student, ExamSchedule; hasMany StudentAnswers

---

## Phase 4: Multi-Tenancy & School System

### Step 4.1: Implement School Isolation

Create a global scope for school-based filtering:

**app/Models/Scopes/SchoolScope.php**

```php
<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SchoolScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (auth()->check() && auth()->user()->role !== 'super_admin') {
            $builder->where('school_id', auth()->user()->school_id);
        }
    }
}
```

Apply to models:

```php
protected static function booted()
{
    static::addGlobalScope(new SchoolScope);
}
```

### Step 4.2: School Registration System

Create controller for school self-registration:

```powershell
php artisan make:controller SchoolRegistrationController
```

**Features:**

- School signup form (name, email, phone, address)
- Auto-generate unique school code
- Create default admin user
- Set initial subscription (trial 7 days)
- Send welcome email with credentials

### Step 4.3: Student Bulk Upload

Create service for CSV processing:

```powershell
php artisan make:service StudentImportService
```

**CSV Format:**

```
student_id,full_name,email,class,department,exam_type,subject1,subject2,subject3,subject4
STU001,John Doe,john@example.com,SS3,Science,JAMB,Mathematics,Physics,Chemistry,Biology
```

**Features:**

- Validate CSV structure
- Check for duplicates
- Create users and students in bulk
- Generate random passwords
- Send credentials via email or downloadable PDF

---

## Phase 5: Authentication & Role System

### Step 5.1: Install Laravel Breeze

```powershell
composer require laravel/breeze --dev
php artisan breeze:install blade
php artisan migrate
npm install && npm run dev
```

### Step 5.2: Modify Authentication for Multi-Role

Update `app/Http/Middleware/RedirectIfAuthenticated.php`:

```php
public function handle(Request $request, Closure $next, string ...$guards): Response
{
    // Redirect based on role
    if (Auth::check()) {
        return match(auth()->user()->role) {
            'super_admin' => redirect('/super-admin/dashboard'),
            'school_admin' => redirect('/admin/dashboard'),
            'student' => redirect('/student/dashboard'),
            default => redirect('/'),
        };
    }
    return $next($request);
}
```

### Step 5.3: Create Role-Based Middleware

```powershell
php artisan make:middleware EnsureSuperAdmin
php artisan make:middleware EnsureSchoolAdmin
php artisan make:middleware EnsureStudent
```

**Register in `app/Http/Kernel.php`:**

```php
protected $middlewareAliases = [
    'super_admin' => \App\Http\Middleware\EnsureSuperAdmin::class,
    'school_admin' => \App\Http\Middleware\EnsureSchoolAdmin::class,
    'student' => \App\Http\Middleware\EnsureStudent::class,
];
```

### Step 5.4: Define Routes by Role

Edit `routes/web.php`:

```php
// Public routes
Route::get('/', function () {
    return view('welcome');
});

// School registration
Route::get('/register-school', [SchoolRegistrationController::class, 'create']);
Route::post('/register-school', [SchoolRegistrationController::class, 'store']);

// Authentication routes (Breeze)
require __DIR__.'/auth.php';

// Super Admin routes
Route::middleware(['auth', 'super_admin'])->prefix('super-admin')->group(function () {
    Route::get('/dashboard', [SuperAdminController::class, 'dashboard']);
    Route::resource('schools', SchoolController::class);
    Route::resource('subscriptions', SubscriptionController::class);
    Route::get('/analytics', [SuperAdminController::class, 'analytics']);
});

// School Admin routes
Route::middleware(['auth', 'school_admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    Route::resource('students', StudentController::class);
    Route::resource('exams', ExamController::class);
    Route::resource('questions', QuestionController::class);
    Route::post('/students/import', [StudentController::class, 'import']);
    Route::post('/questions/generate-ai', [QuestionController::class, 'generateAI']);
    Route::get('/analytics', [AdminController::class, 'analytics']);
});

// Student routes
Route::middleware(['auth', 'student'])->prefix('student')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard']);
    Route::get('/exams', [StudentExamController::class, 'index']);
    Route::get('/exams/{exam}/start', [StudentExamController::class, 'start']);
    Route::get('/exams/{attempt}/continue', [StudentExamController::class, 'continue']);
    Route::get('/results', [StudentResultController::class, 'index']);
    Route::get('/results/{attempt}', [StudentResultController::class, 'show']);
});
```

---

## Phase 6: Livewire Components

### Step 6.1: Install Livewire 3

```powershell
composer require livewire/livewire
php artisan livewire:publish --config
php artisan livewire:publish --assets
```

### Step 6.2: Create Core Livewire Components

**Admin Dashboard Components:**

```powershell
php artisan make:livewire Admin/Dashboard
php artisan make:livewire Admin/StudentManager
php artisan make:livewire Admin/ExamBuilder
php artisan make:livewire Admin/QuestionManager
php artisan make:livewire Admin/AnalyticsDashboard
```

**Student Exam Components:**

```powershell
php artisan make:livewire Student/ExamInterface
php artisan make:livewire Student/ExamDashboard
php artisan make:livewire Student/ResultsView
php artisan make:livewire Student/QuestionGrid
php artisan make:livewire Student/ExamTimer
```

**Shared Components:**

```powershell
php artisan make:livewire Components/Notification
php artisan make:livewire Components/Modal
php artisan make:livewire Components/DataTable
```

### Step 6.3: Example - ExamInterface Livewire Component

**app/Livewire/Student/ExamInterface.php**

```php
<?php

namespace App\Livewire\Student;

use Livewire\Component;
use App\Models\ExamAttempt;
use App\Models\StudentAnswer;

class ExamInterface extends Component
{
    public ExamAttempt $attempt;
    public $currentSubject;
    public $currentQuestionIndex = 0;
    public $questions = [];
    public $answers = [];
    public $timeRemaining;
    public $subjectTimeRemaining;

    protected $listeners = ['answerSelected', 'timerExpired'];

    public function mount($attemptId)
    {
        $this->attempt = ExamAttempt::with(['examSchedule.examQuestions.question'])
            ->findOrFail($attemptId);

        $this->loadQuestions();
        $this->loadAnswers();
        $this->currentSubject = $this->questions[0]['subject_id'] ?? null;
    }

    public function loadQuestions()
    {
        $this->questions = $this->attempt->examSchedule->examQuestions()
            ->with('question', 'subject')
            ->orderBy('subject_id')
            ->orderBy('order')
            ->get()
            ->toArray();
    }

    public function loadAnswers()
    {
        $this->answers = StudentAnswer::where('exam_attempt_id', $this->attempt->id)
            ->pluck('selected_answer', 'question_id')
            ->toArray();
    }

    public function selectAnswer($questionId, $answer)
    {
        StudentAnswer::updateOrCreate(
            [
                'exam_attempt_id' => $this->attempt->id,
                'question_id' => $questionId,
            ],
            [
                'selected_answer' => $answer,
                'subject_id' => $this->currentSubject,
            ]
        );

        $this->answers[$questionId] = $answer;
        $this->dispatch('answer-saved');
    }

    public function goToQuestion($index)
    {
        $this->currentQuestionIndex = $index;
    }

    public function nextQuestion()
    {
        if ($this->currentQuestionIndex < count($this->questions) - 1) {
            $this->currentQuestionIndex++;
            $this->updateSubjectIfNeeded();
        }
    }

    public function previousQuestion()
    {
        if ($this->currentQuestionIndex > 0) {
            $this->currentQuestionIndex--;
            $this->updateSubjectIfNeeded();
        }
    }

    public function switchSubject($subjectId)
    {
        $this->currentSubject = $subjectId;
        $firstQuestionIndex = collect($this->questions)
            ->search(fn($q) => $q['subject_id'] == $subjectId);
        $this->currentQuestionIndex = $firstQuestionIndex !== false ? $firstQuestionIndex : 0;
    }

    public function submitExam()
    {
        $this->attempt->update([
            'completed_at' => now(),
            'status' => 'completed',
        ]);

        $this->calculateScore();

        return redirect()->route('student.results.show', $this->attempt);
    }

    private function calculateScore()
    {
        $answers = StudentAnswer::where('exam_attempt_id', $this->attempt->id)->get();
        $totalScore = 0;
        $subjectScores = [];

        foreach ($answers as $answer) {
            $question = $answer->question;
            $isCorrect = $answer->selected_answer === $question->correct_answer;

            $answer->update(['is_correct' => $isCorrect]);

            if ($isCorrect) {
                $totalScore += 2.5; // 100 marks / 40 questions
                $subjectScores[$answer->subject_id] = ($subjectScores[$answer->subject_id] ?? 0) + 2.5;
            }
        }

        $this->attempt->update([
            'total_score' => $totalScore,
            'percentage' => ($totalScore / 400) * 100,
            'subject_scores' => $subjectScores,
        ]);
    }

    public function render()
    {
        return view('livewire.student.exam-interface', [
            'currentQuestion' => $this->questions[$this->currentQuestionIndex] ?? null,
        ]);
    }
}
```

### Step 6.4: Example - ExamInterface Blade View

**resources/views/livewire/student/exam-interface.blade.php**

```blade
<div class="min-h-screen bg-gray-100" x-data="examInterface()">
    <!-- Header -->
    <div class="bg-white shadow-md px-6 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold">{{ $attempt->examSchedule->exam->title }}</h1>

        <!-- Subject Tabs -->
        <div class="flex gap-2">
            @foreach($attempt->examSchedule->subjects as $subject)
                <button
                    wire:click="switchSubject({{ $subject->id }})"
                    class="px-4 py-2 rounded {{ $currentSubject == $subject->id ? 'bg-purple-600 text-white' : 'bg-gray-200' }}">
                    {{ $subject->name }}
                </button>
            @endforeach
        </div>

        <!-- Timer -->
        <livewire:student.exam-timer :attempt="$attempt" />
    </div>

    <div class="flex h-[calc(100vh-80px)]">
        <!-- Left Panel - Question -->
        <div class="flex-1 p-8 overflow-y-auto">
            @if($currentQuestion)
                <div class="bg-white rounded-lg p-6 shadow">
                    <h2 class="text-lg font-semibold mb-4">
                        Question {{ $currentQuestionIndex + 1 }} of {{ count($questions) }}
                    </h2>

                    <p class="text-gray-800 mb-6">{{ $currentQuestion['question']['question'] }}</p>

                    <!-- Options -->
                    <div class="space-y-3">
                        @foreach(json_decode($currentQuestion['question']['options'], true) as $key => $option)
                            <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-purple-50 transition
                                {{ ($answers[$currentQuestion['question']['id']] ?? null) == $key ? 'border-purple-600 bg-purple-50' : 'border-gray-300' }}">
                                <input
                                    type="radio"
                                    name="answer"
                                    value="{{ $key }}"
                                    wire:click="selectAnswer({{ $currentQuestion['question']['id'] }}, '{{ $key }}')"
                                    {{ ($answers[$currentQuestion['question']['id']] ?? null) == $key ? 'checked' : '' }}
                                    class="mr-3">
                                <span class="font-medium mr-2">{{ $key }}.</span>
                                <span>{{ $option }}</span>
                            </label>
                        @endforeach
                    </div>

                    <!-- Navigation -->
                    <div class="flex justify-between mt-6">
                        <button
                            wire:click="previousQuestion"
                            @disabled($currentQuestionIndex === 0)
                            class="px-6 py-2 bg-gray-200 rounded hover:bg-gray-300 disabled:opacity-50">
                            Previous
                        </button>

                        @if($currentQuestionIndex < count($questions) - 1)
                            <button
                                wire:click="nextQuestion"
                                class="px-6 py-2 bg-purple-600 text-white rounded hover:bg-purple-700">
                                Next
                            </button>
                        @else
                            <button
                                wire:click="submitExam"
                                class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                                Submit Exam
                            </button>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- Right Panel - Question Grid -->
        <div class="w-80 bg-white p-6 border-l overflow-y-auto">
            <h3 class="font-semibold mb-4">Questions</h3>
            <div class="grid grid-cols-5 gap-2">
                @foreach($questions as $index => $question)
                    <button
                        wire:click="goToQuestion({{ $index }})"
                        class="w-10 h-10 rounded flex items-center justify-center text-sm font-medium
                            {{ isset($answers[$question['question']['id']]) ? 'bg-purple-600 text-white' : 'bg-gray-200' }}
                            {{ $index === $currentQuestionIndex ? 'ring-2 ring-purple-800' : '' }}">
                        {{ $index + 1 }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Auto-save indicator -->
    <div wire:loading class="fixed bottom-4 right-4 bg-blue-500 text-white px-4 py-2 rounded shadow">
        Saving...
    </div>
</div>

@script
<script>
    Alpine.data('examInterface', () => ({
        init() {
            // Prevent page refresh
            window.onbeforeunload = () => "Exam in progress. Are you sure you want to leave?";

            // Auto-save to localStorage
            setInterval(() => {
                localStorage.setItem('exam_backup', JSON.stringify(this.$wire.answers));
            }, 5000);
        }
    }));
</script>
@endscript
```

---

## Phase 7: AI Question Generation (GPT-4)

### Step 5.1: Configure Vite for Inertia + React

Edit `backend/vite.config.js`:

```js
import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import react from "@vitejs/plugin-react";

export default defineConfig({
  plugins: [
    laravel({
      input: ["resources/css/app.css", "resources/js/app.tsx"],
      refresh: true,
    }),
    react(),
  ],
  resolve: {
    alias: {
      "@": "/resources/js",
    },
  },
});
```

### Step 5.2: Create Inertia App Entry Point

Create `backend/resources/js/app.tsx`:

```tsx
import "./bootstrap";
import "../css/app.css";

import { createRoot } from "react-dom/client";
import { createInertiaApp } from "@inertiajs/react";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";

const appName =
  window.document.getElementsByTagName("title")[0]?.innerText || "Examine";

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) =>
    resolvePageComponent(
      `./Pages/${name}.tsx`,
      import.meta.glob("./Pages/**/*.tsx")
    ),
  setup({ el, App, props }) {
    const root = createRoot(el);
    root.render(<App {...props} />);
  },
  progress: {
    color: "#4B5563",
  },
});
```

### Step 5.3: Create Base Layout

Create `backend/resources/js/Layouts/AppLayout.tsx`:

```tsx
import React, { ReactNode } from "react";
import { Link } from "@inertiajs/react";
import Navbar from "@/Components/Navbar";
import Footer from "@/Components/Footer";

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
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    "./storage/framework/views/*.php",
    "./resources/views/**/*.blade.php",
    "./resources/js/**/*.tsx",
    "./resources/js/**/*.ts",
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ["Figtree", "sans-serif"],
        arabic: ["Amiri", "serif"],
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
  font-family: "YourFont";
  src: url("/assets/fonts/YourFont.woff2") format("woff2");
}
```

---

## Phase 7: Auth Migration

### Step 7.1: Map Firebase Auth to Laravel Sanctum

**Firebase (examine/src/services/auth.ts) → Laravel**

| Firebase Method                    | Laravel Equivalent                    |
| ---------------------------------- | ------------------------------------- |
| `createUserWithEmailAndPassword()` | `POST /api/register`                  |
| `signInWithEmailAndPassword()`     | `POST /api/login`                     |
| `signOut()`                        | `POST /api/logout`                    |
| `onAuthStateChanged()`             | `GET /api/user` (polling or on mount) |

### Step 7.2: Update AuthContext

Create `backend/resources/js/contexts/AuthContext.tsx`:

```tsx
import React, { createContext, useContext, useState, useEffect } from "react";
import axios from "axios";

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
      const { data } = await axios.get("/api/user");
      setUser(data);
    } catch (error) {
      setUser(null);
    } finally {
      setLoading(false);
    }
  };

  const login = async (email: string, password: string) => {
    await axios.get("/sanctum/csrf-cookie");
    const { data } = await axios.post("/api/login", { email, password });
    setUser(data.user);
  };

  const register = async (
    name: string,
    email: string,
    password: string,
    password_confirmation: string
  ) => {
    await axios.get("/sanctum/csrf-cookie");
    const { data } = await axios.post("/api/register", {
      name,
      email,
      password,
      password_confirmation,
    });
    setUser(data.user);
  };

  const logout = async () => {
    await axios.post("/api/logout");
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
  if (!context) throw new Error("useAuth must be used within AuthProvider");
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

| Firestore Operation            | Laravel API                    |
| ------------------------------ | ------------------------------ |
| `collection('quizzes').get()`  | `GET /api/quizzes`             |
| `doc('quizzes', id).get()`     | `GET /api/quizzes/{id}`        |
| `collection('attempts').add()` | `POST /api/attempts`           |
| `doc('attempts', id).update()` | `PUT /api/attempts/{id}`       |
| `onSnapshot()`                 | Replace with polling or remove |

### Step 8.2: Update QuizContext

Create `backend/resources/js/contexts/QuizContext.tsx`:

```tsx
import React, { createContext, useContext, useState } from "react";
import axios from "axios";
import { Quiz, Question, QuizAttempt } from "@/types";

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
  const [currentAttempt, setCurrentAttempt] = useState<QuizAttempt | null>(
    null
  );

  const loadQuizzes = async () => {
    const { data } = await axios.get("/api/quizzes");
    setQuizzes(data);
  };

  const startQuiz = async (quizId: number) => {
    const { data: quiz } = await axios.get(`/api/quizzes/${quizId}`);
    setCurrentQuiz(quiz);

    const { data: attempt } = await axios.post("/api/attempts", {
      quiz_id: quizId,
    });
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

    const { data } = await axios.post(
      `/api/attempts/${currentAttempt.id}/complete`
    );
    setCurrentAttempt(data);
  };

  return (
    <QuizContext.Provider
      value={{
        quizzes,
        currentQuiz,
        currentAttempt,
        loadQuizzes,
        startQuiz,
        submitAnswer,
        completeQuiz,
      }}
    >
      {children}
    </QuizContext.Provider>
  );
}

export const useQuiz = () => {
  const context = useContext(QuizContext);
  if (!context) throw new Error("useQuiz must be used within QuizProvider");
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


---

##  NEW: Duolingo-Inspired Gamification Vision

This platform transforms traditional CBT into an addictive, mobile-first learning experience inspired by Duolingo's proven engagement mechanics.
