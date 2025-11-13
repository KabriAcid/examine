import "./bootstrap";

import Alpine from "alpinejs";
import NProgress from "nprogress";
import { skeletonLoader } from "./skeleton-loaders";
import Chart from "chart.js/auto";

// Configure NProgress
NProgress.configure({
    minimum: 0.3,
    easing: "ease",
    speed: 200,
    showSpinner: false,
    trickleSpeed: 100,
    trickleRate: 0.05,
});

// Export globally
window.Alpine = Alpine;
window.NProgress = NProgress;
window.skeletonLoader = skeletonLoader;
window.Chart = Chart;

// Livewire navigation loading
document.addEventListener("livewire:navigating", () => {
    NProgress.start();
});

document.addEventListener("livewire:navigated", () => {
    NProgress.done();
});

document.addEventListener("livewire:updating", () => {
    NProgress.inc();
});

document.addEventListener("livewire:updated", () => {
    NProgress.done();
});

Alpine.start();
