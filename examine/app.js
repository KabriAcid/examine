// Main App JavaScript with Firebase Integration
import { 
    signUp, 
    signIn, 
    signInWithGoogle, 
    logout, 
    onAuthStateChange, 
    getCurrentUser 
} from './auth.js';

import { 
    createUserProfile, 
    getUserProfile, 
    saveQuizScore, 
    getUserScores, 
    getLeaderboard, 
    listenToLeaderboard 
} from './database.js';

// DOM Elements
const loginSection = document.getElementById('login-section');
const signupSection = document.getElementById('signup-section');
const userSection = document.getElementById('user-section');
const appContent = document.getElementById('app-content');
const loading = document.getElementById('loading');
const message = document.getElementById('message');

// Auth form elements
const loginEmail = document.getElementById('login-email');
const loginPassword = document.getElementById('login-password');
const loginBtn = document.getElementById('login-btn');
const googleLoginBtn = document.getElementById('google-login-btn');

const signupName = document.getElementById('signup-name');
const signupEmail = document.getElementById('signup-email');
const signupPassword = document.getElementById('signup-password');
const signupBtn = document.getElementById('signup-btn');

const showSignup = document.getElementById('show-signup');
const showLogin = document.getElementById('show-login');
const logoutBtn = document.getElementById('logout-btn');

// User info elements
const userName = document.getElementById('user-name');
const userEmail = document.getElementById('user-email');

// Stats elements
const totalQuizzes = document.getElementById('total-quizzes');
const totalScore = document.getElementById('total-score');
const averageScore = document.getElementById('average-score');

// Test elements
const testDatabaseBtn = document.getElementById('test-database-btn');
const testLeaderboardBtn = document.getElementById('test-leaderboard-btn');
const testResults = document.getElementById('test-results');

// Navigation elements
const viewLeaderboardBtn = document.getElementById('view-leaderboard-btn');
const backToDashboard = document.getElementById('back-to-dashboard');
const leaderboardSection = document.getElementById('leaderboard-section');
const quizSection = document.getElementById('quiz-section');

// App State
let currentUser = null;
let leaderboardUnsubscribe = null;

// Initialize App
document.addEventListener('DOMContentLoaded', () => {
    console.log('🚀 Quran Quiz App Initializing...');
    initializeEventListeners();
    initializeAuthStateListener();
});

// Event Listeners
function initializeEventListeners() {
    // Auth event listeners
    loginBtn.addEventListener('click', handleLogin);
    googleLoginBtn.addEventListener('click', handleGoogleLogin);
    signupBtn.addEventListener('click', handleSignup);
    logoutBtn.addEventListener('click', handleLogout);
    
    // Form toggle listeners
    showSignup.addEventListener('click', (e) => {
        e.preventDefault();
        toggleAuthForms('signup');
    });
    
    showLogin.addEventListener('click', (e) => {
        e.preventDefault();
        toggleAuthForms('login');
    });
    
    // Test listeners
    testDatabaseBtn.addEventListener('click', testDatabaseConnection);
    testLeaderboardBtn.addEventListener('click', testLeaderboardConnection);
    
    // Navigation listeners
    viewLeaderboardBtn.addEventListener('click', showLeaderboard);
    backToDashboard.addEventListener('click', showDashboard);
    
    // Enter key listeners for forms
    loginPassword.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') handleLogin();
    });
    
    signupPassword.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') handleSignup();
    });
}

// Auth State Listener
function initializeAuthStateListener() {
    onAuthStateChange((user) => {
        currentUser = user;
        if (user) {
            console.log('✅ User authenticated:', user.email);
            showUserSection(user);
            loadUserData(user);
        } else {
            console.log('❌ User not authenticated');
            showAuthSection();
        }
        hideLoading();
    });
}

// Auth Handlers
async function handleLogin() {
    const email = loginEmail.value.trim();
    const password = loginPassword.value.trim();
    
    if (!email || !password) {
        showMessage('Please fill in all fields', 'error');
        return;
    }
    
    showLoading();
    const result = await signIn(email, password);
    
    if (result.success) {
        showMessage('Login successful!', 'success');
        clearForm('login');
    } else {
        showMessage(result.error, 'error');
        hideLoading();
    }
}

async function handleGoogleLogin() {
    showLoading();
    const result = await signInWithGoogle();
    
    if (result.success) {
        showMessage('Google login successful!', 'success');
    } else {
        showMessage(result.error, 'error');
        hideLoading();
    }
}

async function handleSignup() {
    const name = signupName.value.trim();
    const email = signupEmail.value.trim();
    const password = signupPassword.value.trim();
    
    if (!name || !email || !password) {
        showMessage('Please fill in all fields', 'error');
        return;
    }
    
    if (password.length < 6) {
        showMessage('Password must be at least 6 characters', 'error');
        return;
    }
    
    showLoading();
    const result = await signUp(email, password, name);
    
    if (result.success) {
        showMessage('Account created successfully!', 'success');
        clearForm('signup');
        
        // Create user profile in Firestore
        await createUserProfile(result.user.uid, {
            displayName: result.user.displayName,
            email: result.user.email
        });
    } else {
        showMessage(result.error, 'error');
        hideLoading();
    }
}

async function handleLogout() {
    showLoading();
    const result = await logout();
    
    if (result.success) {
        showMessage('Logged out successfully!', 'success');
        if (leaderboardUnsubscribe) {
            leaderboardUnsubscribe();
            leaderboardUnsubscribe = null;
        }
    } else {
        showMessage(result.error, 'error');
    }
    hideLoading();
}

// UI Functions
function showAuthSection() {
    loginSection.classList.remove('hidden');
    signupSection.classList.add('hidden');
    userSection.classList.add('hidden');
    appContent.classList.add('hidden');
}

function showUserSection(user) {
    loginSection.classList.add('hidden');
    signupSection.classList.add('hidden');
    userSection.classList.remove('hidden');
    appContent.classList.remove('hidden');
    
    userName.textContent = user.displayName || 'User';
    userEmail.textContent = user.email;
}

function toggleAuthForms(form) {
    if (form === 'signup') {
        loginSection.classList.add('hidden');
        signupSection.classList.remove('hidden');
    } else {
        signupSection.classList.add('hidden');
        loginSection.classList.remove('hidden');
    }
}

function clearForm(formType) {
    if (formType === 'login') {
        loginEmail.value = '';
        loginPassword.value = '';
    } else if (formType === 'signup') {
        signupName.value = '';
        signupEmail.value = '';
        signupPassword.value = '';
    }
}

function showLoading() {
    loading.classList.remove('hidden');
}

function hideLoading() {
    loading.classList.add('hidden');
}

function showMessage(text, type = 'info') {
    message.textContent = text;
    message.className = type;
    message.classList.remove('hidden');
    
    setTimeout(() => {
        message.classList.add('hidden');
    }, 5000);
}

// User Data Functions
async function loadUserData(user) {
    try {
        const result = await getUserProfile(user.uid);
        if (result.success) {
            const userData = result.data;
            totalQuizzes.textContent = userData.totalQuizzes || 0;
            totalScore.textContent = userData.totalScore || 0;
            averageScore.textContent = (userData.averageScore || 0).toFixed(1);
        }
    } catch (error) {
        console.error('Error loading user data:', error);
    }
}

// Test Functions
async function testDatabaseConnection() {
    testResults.textContent = 'Testing database connection...\n';
    
    try {
        if (!currentUser) {
            testResults.textContent += '❌ No authenticated user\n';
            return;
        }
        
        // Test user profile retrieval
        testResults.textContent += '📋 Testing user profile retrieval...\n';
        const userResult = await getUserProfile(currentUser.uid);
        
        if (userResult.success) {
            testResults.textContent += '✅ User profile retrieved successfully\n';
            testResults.textContent += `📊 Data: ${JSON.stringify(userResult.data, null, 2)}\n`;
        } else {
            testResults.textContent += `❌ Error: ${userResult.error}\n`;
        }
        
        // Test saving a dummy quiz score
        testResults.textContent += '\n🎯 Testing quiz score save...\n';
        const scoreResult = await saveQuizScore(currentUser.uid, 'test-quiz-id', {
            score: 85,
            totalQuestions: 10,
            correctAnswers: 8,
            incorrectAnswers: 2,
            timeSpent: 120
        });
        
        if (scoreResult.success) {
            testResults.textContent += '✅ Quiz score saved successfully\n';
        } else {
            testResults.textContent += `❌ Error saving score: ${scoreResult.error}\n`;
        }
        
        // Test retrieving user scores
        testResults.textContent += '\n📈 Testing user scores retrieval...\n';
        const scoresResult = await getUserScores(currentUser.uid, 5);
        
        if (scoresResult.success) {
            testResults.textContent += `✅ Retrieved ${scoresResult.data.length} scores\n`;
            if (scoresResult.data.length > 0) {
                testResults.textContent += `📊 Latest score: ${JSON.stringify(scoresResult.data[0], null, 2)}\n`;
            }
        } else {
            testResults.textContent += `❌ Error retrieving scores: ${scoresResult.error}\n`;
        }
        
    } catch (error) {
        testResults.textContent += `❌ Unexpected error: ${error.message}\n`;
    }
}

async function testLeaderboardConnection() {
    testResults.textContent = 'Testing leaderboard connection...\n';
    
    try {
        testResults.textContent += '🏆 Testing leaderboard retrieval...\n';
        const leaderboardResult = await getLeaderboard(10);
        
        if (leaderboardResult.success) {
            testResults.textContent += `✅ Retrieved ${leaderboardResult.data.length} leaderboard entries\n`;
            
            if (leaderboardResult.data.length > 0) {
                testResults.textContent += '\n🥇 Top 3 Players:\n';
                leaderboardResult.data.slice(0, 3).forEach((entry, index) => {
                    testResults.textContent += `${index + 1}. User ${entry.userId} - ${entry.totalScore} points\n`;
                });
            } else {
                testResults.textContent += '📝 No leaderboard entries found\n';
            }
        } else {
            testResults.textContent += `❌ Error: ${leaderboardResult.error}\n`;
        }
        
    } catch (error) {
        testResults.textContent += `❌ Unexpected error: ${error.message}\n`;
    }
}

// Navigation Functions
function showLeaderboard() {
    quizSection.classList.add('hidden');
    leaderboardSection.classList.remove('hidden');
    loadLeaderboard();
}

function showDashboard() {
    leaderboardSection.classList.add('hidden');
    quizSection.classList.remove('hidden');
}

async function loadLeaderboard() {
    const leaderboardList = document.getElementById('leaderboard-list');
    leaderboardList.innerHTML = '<p>Loading leaderboard...</p>';
    
    try {
        const result = await getLeaderboard(20);
        
        if (result.success) {
            if (result.data.length === 0) {
                leaderboardList.innerHTML = '<p>No leaderboard entries yet. Be the first to take a quiz!</p>';
                return;
            }
            
            leaderboardList.innerHTML = '';
            result.data.forEach((entry, index) => {
                const item = document.createElement('div');
                item.className = 'leaderboard-item';
                item.innerHTML = `
                    <div class="leaderboard-rank">#${index + 1}</div>
                    <div class="leaderboard-info">
                        <div class="leaderboard-name">User ${entry.userId.substring(0, 8)}...</div>
                        <div>Quizzes: ${entry.totalQuizzes} | Avg: ${entry.averageScore.toFixed(1)}</div>
                    </div>
                    <div class="leaderboard-score">${entry.totalScore} pts</div>
                `;
                leaderboardList.appendChild(item);
            });
        } else {
            leaderboardList.innerHTML = `<p>Error loading leaderboard: ${result.error}</p>`;
        }
    } catch (error) {
        leaderboardList.innerHTML = `<p>Error loading leaderboard: ${error.message}</p>`;
    }
}

// Export functions for testing
window.testApp = {
    testDatabaseConnection,
    testLeaderboardConnection,
    getCurrentUser: () => currentUser
};
