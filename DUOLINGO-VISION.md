# 🎯 Examine Platform: Duolingo-Inspired Learning System

## Executive Summary

**Transform JAMB/WAEC exam prep from boring to addictive.**

We're building a mobile-first, gamified learning platform that makes studying feel like playing a game. Students earn XP points, maintain daily streaks, compete in weekly leagues, and unlock achievements—all while practicing MCQ questions for their exams.

---

## 🌟 Core Philosophy

### What Makes Duolingo Work?

- ✨ Bite-sized lessons (5-10 minutes)
- 🏆 XP points & levels
- 🔥 Daily streaks (FOMO driver)
- ❤️ Hearts system (stakes)
- 🎯 Clear progression
- 💎 Premium tier with perks

### Our Adaptation

- 📚 10-question lessons (~5 min each)
- ⭐ 10-50 XP per correct answer
- 🔥 Daily streaks with milestones
- ❤️ 5 hearts (lose 1 per wrong answer)
- 🏅 Weekly leagues (Bronze → Diamond)
- 👑 Premium: Unlimited hearts + more

---

## 🎮 Key Features

### 1. **XP & Leveling System**

```
Correct Answer (Easy):    +10 XP
Correct Answer (Medium):  +20 XP
Correct Answer (Hard):    +50 XP
Perfect Lesson (10/10):   +100 XP Bonus
Daily Streak:             +25 XP
Complete Topic:           +200 XP
```

**Levels:**

- Level 1: 0 XP
- Level 5: 500 XP
- Level 10: 1,500 XP
- Level 50: 20,000 XP (Legend 👑)

### 2. **Hearts System** ❤️

- **Free Users**: 5 hearts, refill 1/hour
- **Lose 1 heart** per wrong answer
- **Out of hearts?** Watch ad, wait, or go premium
- **Premium Users**: Unlimited hearts

### 3. **Daily Streaks** 🔥

- Complete 1 lesson daily to maintain streak
- **Milestones:**
  - 🔥 7 days: +150 XP + Silver badge
  - 🔥 30 days: +1000 XP + Gold badge
  - 🔥 100 days: +5000 XP + Legend badge
- **Premium Perk**: Streak freeze (saves you if you miss a day)

### 4. **Weekly Leagues** 🏆

50 students per league, resets every Monday:

| League  | Promotion            | Demotion          | Reward  |
| ------- | -------------------- | ----------------- | ------- |
| Bronze  | Top 10 → Silver      | -                 | 50 XP   |
| Silver  | Top 10 → Gold        | Bottom 5 → Bronze | 150 XP  |
| Gold    | Top 10 → Diamond     | Bottom 5 → Silver | 300 XP  |
| Diamond | Top 3 → Hall of Fame | Bottom 5 → Gold   | 1000 XP |

### 5. **Achievements** 🎖️

- 🎯 First Steps (complete first lesson)
- 💯 Perfectionist (10/10 in a lesson)
- 🔥 Dedicated (7-day streak)
- ⚡ Speed Demon (answer fast)
- 🎓 Subject Master (complete all topics)

### 6. **Subject Skill Trees** 📚

Unlock topics progressively:

```
Mathematics
├── ✅ Basic Arithmetic (⭐⭐⭐)
├── 🔓 Algebra (⭐⭐☆)
│   ├── ✅ Linear Equations
│   ├── 🔓 Quadratic Equations
│   └── 🔒 Inequalities (locked)
├── 🔒 Geometry (complete Algebra first)
└── 🔒 Trigonometry
```

---

## 📱 Mobile-First Design

### Screen Layout

```
┌─────────────────────────────┐
│ 👋 Hi Ahmed!         ❤️❤️❤️ │
│ 🔥 7 Day Streak     ⭐2,450 │
├─────────────────────────────┤
│                             │
│  What is 2x + 5 = ?         │
│  when x = 3                 │
│                             │
│  ┌───────────────────────┐  │
│  │   A. 8                │  │
│  └───────────────────────┘  │
│  ┌───────────────────────┐  │
│  │   B. 11 ✓             │  │
│  └───────────────────────┘  │
│  ┌───────────────────────┐  │
│  │   C. 13               │  │
│  └───────────────────────┘  │
│  ┌───────────────────────┐  │
│  │   D. 16               │  │
│  └───────────────────────┘  │
│                             │
├─────────────────────────────┤
│     [CHECK ANSWER]          │
└─────────────────────────────┘
```

### Design Principles

1. **Thumb-Friendly**: All buttons within thumb reach
2. **One Task Per Screen**: No cognitive overload
3. **Instant Feedback**: Animations + haptics
4. **Large Touch Targets**: Minimum 48x48px
5. **Joyful Interactions**: Confetti, bounces, shakes

---

## 💎 Premium Features

### Free vs Premium

| Feature       | Free              | Premium (₦2,500/mo) |
| ------------- | ----------------- | ------------------- |
| Hearts        | 5 (1/hour refill) | ❤️ Unlimited        |
| Ads           | Yes               | ❌ None             |
| Streak Freeze | ❌                | ✅ 1 per week       |
| Offline Mode  | ❌                | ✅ Download lessons |
| Analytics     | Basic             | 📊 Advanced         |
| Support       | ❌                | ✅ 24/7 chat        |

### Pricing Tiers

- **Monthly**: ₦2,500
- **Quarterly**: ₦6,000 (save 20%)
- **Yearly**: ₦18,000 (save 40%)

---

## 🎨 Visual Design

### Color Palette

```css
/* Success (Correct answers) */
--success-500: #22c55e;

/* Energy (Streaks) */
--warning-500: #f97316; 🔥

/* Error (Wrong answers) */
--error-500: #ef4444;

/* Primary (CTAs) */
--primary-500: #6366f1;

/* Premium */
--secondary-500: #a855f7; 💎
```

### Animations

- ✅ **Correct**: Green confetti + "+10 XP" bounce
- ❌ **Wrong**: Red shake + heart breaks
- 🔥 **Streak**: Fire flicker animation
- 🏆 **Level Up**: Trophy burst + confetti
- ⭐ **XP Gain**: Counter animation (0 → 2,450)

---

## 🗄️ New Database Tables

### user_stats

```sql
- total_xp (INT)
- current_level (INT)
- current_streak (INT)
- total_hearts (INT, default 5)
- last_active_date (DATE)
```

### achievements

```sql
- name (VARCHAR)
- description (TEXT)
- xp_reward (INT)
- badge_image (VARCHAR)
```

### user_achievements

```sql
- user_id
- achievement_id
- earned_at
```

### leagues

```sql
- name (bronze, silver, gold, diamond)
- promotion_threshold
- demotion_threshold
```

### user_league_week

```sql
- user_id
- league_id
- week_start
- weekly_xp
- final_rank
```

### topics (Skill Tree)

```sql
- subject_id
- parent_topic_id
- name
- difficulty_level
- unlock_requirement
- icon
```

---

## 🚀 Implementation Roadmap

### Week 1-2: Core Learning

- ✅ MCQ practice component (Livewire)
- ✅ Answer checking with feedback
- ✅ Basic XP tracking
- ✅ Mobile-first layouts

### Week 3-4: Gamification

- 🔄 Hearts system (lose/refill logic)
- 🔄 Daily streak tracking
- 🔄 XP levels & dashboard
- 🔄 Subject progress trees

### Week 5-6: Social Features

- ⏳ Weekly leagues system
- ⏳ Leaderboards (50 per league)
- ⏳ Achievements unlocking
- ⏳ Profile with badges

### Week 7-8: Premium

- ⏳ Paystack integration
- ⏳ Unlimited hearts for premium
- ⏳ Streak freeze feature
- ⏳ Offline mode (PWA)

### Week 9-10: Launch

- ⏳ Mobile app (PWA)
- ⏳ Push notifications
- ⏳ Performance optimization
- ⏳ Beta testing with students

---

## 📊 Success Metrics (KPIs)

### Engagement

- **Daily Active Users (DAU)**: Target >60%
- **Streak Retention**: >40% maintain 7+ day streak
- **Session Duration**: >10 minutes average
- **Questions/Day**: >30 per active user

### Monetization

- **Free → Premium Conversion**: Target >5%
- **Average Revenue Per User**: >₦1,000/month
- **Churn Rate**: <10%/month

### Learning Outcomes

- **Accuracy Improvement**: >15% (month 1 → month 2)
- **Topic Completion**: >70% finish what they start
- **Student Satisfaction**: >4.5/5 stars

---

## 💻 Tech Stack

### Frontend

- **Framework**: Laravel 11 + Livewire 3
- **Animations**: Alpine.js (replacing Framer Motion)
- **Styling**: Tailwind CSS (mobile-first)
- **Icons**: Lucide Icons
- **Font**: Ginto (premium feel)

### Backend

- **PHP**: 8.2+
- **Database**: MySQL 8.0 (InnoDB)
- **Caching**: Redis (leaderboards, stats)
- **Queue**: Laravel Queue (for slow operations)
- **Real-time**: Livewire polling

### PWA (Progressive Web App)

- **Workbox**: Offline support
- **Manifest**: Installable app
- **Service Worker**: Background sync

### Integrations

- **AI**: OpenAI GPT-4.1 (question generation)
- **Payment**: Paystack (subscriptions)
- **Push**: Firebase Cloud Messaging
- **Analytics**: Google Analytics 4

---

## 🎯 Why This Will Work

### Psychological Triggers

1. **Progress**: XP bars show visible growth
2. **Achievement**: Badges satisfy completionist desire
3. **Competition**: Leagues tap into rivalry
4. **FOMO**: Streaks create daily habit
5. **Stakes**: Hearts make mistakes matter
6. **Reward**: Instant XP gratification

### Proven Model

- Duolingo: 500M+ users, $500M+ revenue
- Khan Academy: Gamification boosted engagement 2x
- Quizlet: 60M+ students use it monthly

### Market Fit

- **Problem**: Boring exam prep, low engagement
- **Solution**: Make it fun, addictive, social
- **Market**: 1.8M JAMB candidates yearly
- **Monetization**: Freemium (proven model)

---

## 🎓 Next Steps

1. **Validate with Students** (Week 1)

   - Show mockups to 20 students
   - Get feedback on UI/UX
   - Iterate on design

2. **Build MVP** (Week 2-4)

   - Core learning flow (10-question lessons)
   - XP + Hearts + Streaks
   - Basic dashboard

3. **Beta Launch** (Week 5-6)

   - 100 students (1 school)
   - Track DAU, streak %, session time
   - Fix bugs, optimize UX

4. **Add Premium** (Week 7-8)

   - Payment integration
   - Premium perks active
   - A/B test pricing

5. **Scale** (Week 9-12)
   - Expand to 10 schools
   - Monitor conversion rates
   - National marketing campaign

---

## 📞 Contact & Resources

**Project Lead**: [Your Name]  
**Start Date**: November 13, 2025  
**Launch Target**: Q1 2026

**Design References**:

- Duolingo mobile app
- Khan Academy gamification
- Quizlet Learn mode

**Code Repository**: `examine/`  
**Documentation**: `guide.md` (detailed technical guide)

---

**Let's make exam prep addictive! 🚀🎉**
