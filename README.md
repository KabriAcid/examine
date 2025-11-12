## 🧭 Complete Development Guide for AI-Powered JAMB/WAEC Mock CBT System

### 🎯 Project Overview

This project aims to build a **multi-school web-based CBT platform** that simulates JAMB and WAEC-style exams for students to practice. Each school can register, add students, and manage exams. The system will feature **AI-generated questions** using the **OpenAI GPT-4.1 API**, and provide smooth exam interactions similar to Exambly or JAMB’s official platform.

The project will be built with **Laravel 11**, **Livewire 3**, **Alpine.js**, **Tailwind CSS**, **Lucide React Icons**, and **Framer Motion (via JS)** for animations. The database will be **MySQL** (InnoDB engine) hosted on **shared hosting**.

---

### 🧱 Project Structure Overview

```
app/
├── Http/
│   ├── Controllers/
│   ├── Livewire/
│   ├── Middleware/
│   └── Requests/
├── Models/
├── Services/AI/          # GPT integration and prompt handlers
├── Helpers/              # Utility and helper functions
└── Providers/
resources/
├── views/                # Blade + Livewire views
│   ├── layouts/
│   ├── student/
│   └── admin/
├── css/
└── js/
public/
└── uploads/
```

---

### ⚙️ Core Functional Modules

#### 1. **School Module**

* Each school registers via a dedicated portal.
* After registration, a subdomain or unique identifier (school_code) is created.
* Schools can upload students using CSV templates.
* Each school has its own admins (staff users).

#### 2. **Student Module**

* Students log in using their unique ID and password.
* Can view dashboard, available exams, and results.
* Data stored per school to prevent cross-access.

#### 3. **Exam Module**

* Admins create exams with:

  * Title (e.g., WAEC Mock 2025)
  * Duration (2 hours total / 30 mins per subject)
  * 4 subjects per student.
  * Questions assigned per subject.
* Exam attempts are tracked and auto-submitted on timeout.

#### 4. **AI Question Generation Module (GPT-4.1)**

AI is used to generate new question sets dynamically. Admins can specify:

* Subject name
* Topic/subtopic
* Difficulty level (basic/intermediate/advanced)
* Number of questions
* Option type (A–D or A–E/F)

##### Example GPT Prompt:

```
Generate 10 multiple-choice questions for the subject "Physics" under the topic "Waves and Vibrations" suitable for WAEC/JAMB level.
Each question should have the following structure:

{
  "question": "<Question text>",
  "options": {
    "A": "<Option 1>",
    "B": "<Option 2>",
    "C": "<Option 3>",
    "D": "<Option 4>"
  },
  "correct_answer": "A/B/C/D",
  "explanation": "<Short explanation>"
}

Make sure questions are accurate, contextually relevant, and follow the Nigerian WAEC/JAMB format.
```

##### Extended Prompt for Five Options (A–E):

```
Generate 10 multiple-choice questions for the subject "Biology" under the topic "Genetics" suitable for JAMB level.
Each question should have FIVE options labeled A to E. Follow this JSON structure:
{
  "question": "<Question text>",
  "options": {
    "A": "<Option A>",
    "B": "<Option B>",
    "C": "<Option C>",
    "D": "<Option D>",
  },
  "correct_answer": "A/B/C/D/",
  "explanation": "<Reasoning behind the answer>"
}
```

#### 5. **Question Management**

* Questions can be **generated (AI)** or **uploaded via CSV**.
* CSV format:
  `subject, question, optionA, optionB, optionC, optionD, correctAnswer, explanation`
* Each question is linked to a specific school and subject.

#### 6. **Exam Interface (Student View)**

* Full-screen environment with:

  * Header: Exam name, Subject tabs, Countdown timer
  * Left panel: Question text + options (A–D)
  * Right panel: Question numbers grid
* Real-time behaviors:

  * Auto-save selected answers to DB
  * Auto-submit on timeout
  * LocalStorage backup to prevent data loss
  * Smooth navigation (next/prev/subject switch)
  * Color hierarchy for question states:

    * **Answered** → Purple
    * **Unanswered** → Gray
    * **Current** → Purple border
    * **Flagged** → Orange

#### 7. **Timer & Auto-Save Mechanism**

* Global 2-hour timer per exam.
* 30-minute sub-timer per subject.
* Auto-save progress every 10 seconds (via Livewire polling).
* Auto-submit when timer expires.

#### 8. **Results & Analytics**

* Result summary page:

  * Total score & percentage
  * Subject-wise performance breakdown
  * Correct vs Incorrect visualization (charts)
  * Answer review (with correct answers highlighted)

#### 9. **Subscription & Billing**

* Schools pay based on number of students (tiers e.g., 50, 200, 500, etc.)
* Integrate Paystack/Flutterwave for subscription billing.
* Subscription expiry disables student login.

#### 10. **System Management**

* Super Admin panel for global control.
* Features:

  * Manage schools, subscriptions, payments
  * Monitor active exams & logs
  * Generate usage reports

---

### 🧠 Data Flow Summary

1. Admin creates exam → selects AI generation or uploads questions.
2. Students log in → start exam → all questions preloaded.
3. As students answer, Livewire updates the DB asynchronously.
4. On submit or timeout → system computes result → saves & displays summary.
5. Admin reviews analytics via dashboard.

---

### 🔐 Key Functionalities to Implement

* Protected routes with roles (super admin, school admin, student)
* Prevent page refresh or navigation during exams
* Session restore from localStorage if browser closes
* Responsive design for tablets/laptops
* Global state via Livewire store
* Toast notifications (success/error/info)

---

### 📊 Recommended Database Tables (MySQL)

* `users` → stores all users (role-based)
* `schools` → registered institutions
* `students` → student data linked to school
* `subjects` → subject list
* `questions` → question pool (AI or uploaded)
* `exams` → exams created per school
* `exam_questions` → question mapping for each exam
* `exam_attempts` → tracks each student’s session
* `student_answers` → stores answers during exams
* `subscriptions` → billing & plan tracking
* `ai_prompts` → stores prompt templates and logs

---

### 🧩 Future Enhancements

* AI-based performance feedback (identify weak areas)
* AI question difficulty balancing
* Real-time leaderboard for schools
* Offline support via PWA (optional)

---

### 🚀 Development Workflow Summary

1. Setup Laravel + Livewire base.
2. Create database schema.
3. Build authentication & school registration.
4. Implement student dashboard & exam modules.
5. Integrate GPT-4.1 API for question generation.
6. Add Livewire exam interface + auto-save logic.
7. Integrate payments & subscription management.
8. Deploy to shared hosting.

---

### ✅ Goal

Deliver a **scalable, AI-enhanced CBT platform** that simulates real exam conditions while being easily adoptable by multiple schools without complex multi-tenancy. The use of **MySQL**, **Livewire**, and **GPT-4.1** ensures simplicity, interactivity, and modern functionality.


