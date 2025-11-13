// Firestore Database Module for Quran Quiz App
import {
  collection,
  doc,
  getDoc,
  getDocs,
  setDoc,
  updateDoc,
  deleteDoc,
  addDoc,
  query,
  where,
  orderBy,
  limit,
  onSnapshot,
  serverTimestamp,
  increment,
} from "firebase/firestore";
import { db } from "./firebase-config.js";

// Collections
const USERS_COLLECTION = "users";
const QUIZZES_COLLECTION = "quizzes";
const SCORES_COLLECTION = "scores";
const LEADERBOARD_COLLECTION = "leaderboard";

// User Management
export const createUserProfile = async (userId, userData) => {
  try {
    const userRef = doc(db, USERS_COLLECTION, userId);
    await setDoc(userRef, {
      ...userData,
      createdAt: serverTimestamp(),
      totalQuizzes: 0,
      totalScore: 0,
      averageScore: 0,
      lastActive: serverTimestamp(),
    });
    return { success: true };
  } catch (error) {
    return { success: false, error: error.message };
  }
};

export const getUserProfile = async (userId) => {
  try {
    const userRef = doc(db, USERS_COLLECTION, userId);
    const userSnap = await getDoc(userRef);

    if (userSnap.exists()) {
      return { success: true, data: userSnap.data() };
    } else {
      return { success: false, error: "User profile not found" };
    }
  } catch (error) {
    return { success: false, error: error.message };
  }
};

export const updateUserProfile = async (userId, updateData) => {
  try {
    const userRef = doc(db, USERS_COLLECTION, userId);
    await updateDoc(userRef, {
      ...updateData,
      lastActive: serverTimestamp(),
    });
    return { success: true };
  } catch (error) {
    return { success: false, error: error.message };
  }
};

// Quiz Management
export const createQuiz = async (quizData) => {
  try {
    const quizRef = await addDoc(collection(db, QUIZZES_COLLECTION), {
      ...quizData,
      createdAt: serverTimestamp(),
      isActive: true,
    });
    return { success: true, id: quizRef.id };
  } catch (error) {
    return { success: false, error: error.message };
  }
};

export const getQuiz = async (quizId) => {
  try {
    const quizRef = doc(db, QUIZZES_COLLECTION, quizId);
    const quizSnap = await getDoc(quizRef);

    if (quizSnap.exists()) {
      return { success: true, data: { id: quizSnap.id, ...quizSnap.data() } };
    } else {
      return { success: false, error: "Quiz not found" };
    }
  } catch (error) {
    return { success: false, error: error.message };
  }
};

export const getAllQuizzes = async () => {
  try {
    const q = query(
      collection(db, QUIZZES_COLLECTION),
      where("isActive", "==", true),
      orderBy("createdAt", "desc")
    );

    const querySnapshot = await getDocs(q);
    const quizzes = [];

    querySnapshot.forEach((doc) => {
      quizzes.push({ id: doc.id, ...doc.data() });
    });

    return { success: true, data: quizzes };
  } catch (error) {
    return { success: false, error: error.message };
  }
};

// Score Management
export const saveQuizScore = async (userId, quizId, scoreData) => {
  try {
    const scoreRef = await addDoc(collection(db, SCORES_COLLECTION), {
      userId,
      quizId,
      score: scoreData.score,
      totalQuestions: scoreData.totalQuestions,
      correctAnswers: scoreData.correctAnswers,
      incorrectAnswers: scoreData.incorrectAnswers,
      timeSpent: scoreData.timeSpent,
      completedAt: serverTimestamp(),
    });

    // Update user statistics
    await updateUserStats(userId, scoreData.score);

    // Update leaderboard
    await updateLeaderboard(userId, scoreData.score);

    return { success: true, id: scoreRef.id };
  } catch (error) {
    return { success: false, error: error.message };
  }
};

export const getUserScores = async (userId, limitCount = 10) => {
  try {
    const q = query(
      collection(db, SCORES_COLLECTION),
      where("userId", "==", userId),
      orderBy("completedAt", "desc"),
      limit(limitCount)
    );

    const querySnapshot = await getDocs(q);
    const scores = [];

    querySnapshot.forEach((doc) => {
      scores.push({ id: doc.id, ...doc.data() });
    });

    return { success: true, data: scores };
  } catch (error) {
    return { success: false, error: error.message };
  }
};

export const getQuizScores = async (quizId, limitCount = 10) => {
  try {
    const q = query(
      collection(db, SCORES_COLLECTION),
      where("quizId", "==", quizId),
      orderBy("score", "desc"),
      limit(limitCount)
    );

    const querySnapshot = await getDocs(q);
    const scores = [];

    querySnapshot.forEach((doc) => {
      scores.push({ id: doc.id, ...doc.data() });
    });

    return { success: true, data: scores };
  } catch (error) {
    return { success: false, error: error.message };
  }
};

// Leaderboard Management
export const updateLeaderboard = async (userId, score) => {
  try {
    const leaderboardRef = doc(db, LEADERBOARD_COLLECTION, userId);
    const leaderboardSnap = await getDoc(leaderboardRef);

    if (leaderboardSnap.exists()) {
      const currentData = leaderboardSnap.data();
      await updateDoc(leaderboardRef, {
        totalScore: increment(score),
        totalQuizzes: increment(1),
        averageScore:
          (currentData.totalScore + score) / (currentData.totalQuizzes + 1),
        lastUpdated: serverTimestamp(),
      });
    } else {
      await setDoc(leaderboardRef, {
        userId,
        totalScore: score,
        totalQuizzes: 1,
        averageScore: score,
        lastUpdated: serverTimestamp(),
      });
    }

    return { success: true };
  } catch (error) {
    return { success: false, error: error.message };
  }
};

export const getLeaderboard = async (limitCount = 20) => {
  try {
    const q = query(
      collection(db, LEADERBOARD_COLLECTION),
      orderBy("totalScore", "desc"),
      limit(limitCount)
    );

    const querySnapshot = await getDocs(q);
    const leaderboard = [];

    querySnapshot.forEach((doc) => {
      leaderboard.push({ id: doc.id, ...doc.data() });
    });

    return { success: true, data: leaderboard };
  } catch (error) {
    return { success: false, error: error.message };
  }
};

// Helper function to update user statistics
const updateUserStats = async (userId, score) => {
  try {
    const userRef = doc(db, USERS_COLLECTION, userId);
    const userSnap = await getDoc(userRef);

    if (userSnap.exists()) {
      const currentData = userSnap.data();
      const newTotalQuizzes = (currentData.totalQuizzes || 0) + 1;
      const newTotalScore = (currentData.totalScore || 0) + score;

      await updateDoc(userRef, {
        totalQuizzes: newTotalQuizzes,
        totalScore: newTotalScore,
        averageScore: newTotalScore / newTotalQuizzes,
        lastActive: serverTimestamp(),
      });
    }
  } catch (error) {
    console.error("Error updating user stats:", error);
  }
};

// Real-time listeners
export const listenToLeaderboard = (callback, limitCount = 20) => {
  const q = query(
    collection(db, LEADERBOARD_COLLECTION),
    orderBy("totalScore", "desc"),
    limit(limitCount)
  );

  return onSnapshot(q, (querySnapshot) => {
    const leaderboard = [];
    querySnapshot.forEach((doc) => {
      leaderboard.push({ id: doc.id, ...doc.data() });
    });
    callback(leaderboard);
  });
};

export const listenToUserScores = (userId, callback, limitCount = 10) => {
  const q = query(
    collection(db, SCORES_COLLECTION),
    where("userId", "==", userId),
    orderBy("completedAt", "desc"),
    limit(limitCount)
  );

  return onSnapshot(q, (querySnapshot) => {
    const scores = [];
    querySnapshot.forEach((doc) => {
      scores.push({ id: doc.id, ...doc.data() });
    });
    callback(scores);
  });
};
