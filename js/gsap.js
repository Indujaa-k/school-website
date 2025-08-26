document.addEventListener('DOMContentLoaded', (event) => {
    gsap.registerPlugin(ScrollTrigger);

    // Timeline for the text section
    const textTimeline = gsap.timeline({
        scrollTrigger: {
            trigger: ".text-section",
            start: "top center",
            toggleActions: "play none none none"
        }
    });

    textTimeline
        .from(".animate-text", {
            duration: 1,
            y: 50,
            opacity: 0,
            stagger: 0.3,
            ease: "power2.out"
        })
        .from(".animate-input", {
            duration: 0.8,
            x: -50,
            opacity: 0,
            stagger: 0.2,
            ease: "power2.out"
        }, "-=0.5") // start this animation 0.5 seconds before the previous one ends
        .from(".animate-button", {
            duration: 0.8,
            y: 20,
            opacity: 0,
            ease: "power2.out"
        }, "-=0.3");

    // Animation for the images
    gsap.utils.toArray(".animate-image").forEach(image => {
        gsap.from(image, {
            duration: 1.5,
            y: 100,
            scale: 0.8,
            opacity: 0,
            ease: "power3.out",
            scrollTrigger: {
                trigger: image,
                start: "top 80%",
                toggleActions: "play none none none",
            }
        });
    });
});