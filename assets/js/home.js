const scrollTopButton = document.getElementById("scroll-top-button");
scrollTopButton.onclick = _ => document.getElementsByTagName("nav")[0].scrollIntoView({ behavior: "smooth", block: "start" });

const scrollDownButton = document.getElementById("scroll-down-button");
scrollDownButton.onclick = _ => document.getElementById("homeCarousel").scrollIntoView({ behavior: "smooth", block: "start" });