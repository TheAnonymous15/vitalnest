<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Rajdhani', sans-serif;
        background: linear-gradient(to bottom right, #0f172a 0%, #1e293b 50%, #0f172a 100%);
        overflow: hidden;
        position: relative;
        height: 100vh;
    }

    /* Alien Grid Background */
    .grid-background {
        position: fixed;
        inset: 0;
        background-image:
            linear-gradient(rgba(34, 211, 238, 0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(34, 211, 238, 0.03) 1px, transparent 1px);
        background-size: 50px 50px;
        animation: gridMove 20s linear infinite;
        perspective: 1000px;
        transform-style: preserve-3d;
    }

    @keyframes gridMove {
        0% { background-position: 0 0; }
        100% { background-position: 50px 50px; }
    }

    /* Nebula Background */
    .nebula {
        position: fixed;
        width: 100%;
        height: 100%;
        background: radial-gradient(ellipse at 20% 30%, rgba(34, 211, 238, 0.15) 0%, transparent 50%),
                    radial-gradient(ellipse at 80% 70%, rgba(249, 115, 22, 0.15) 0%, transparent 50%),
                    radial-gradient(ellipse at 50% 50%, rgba(139, 92, 246, 0.1) 0%, transparent 50%);
        filter: blur(60px);
        animation: nebulaPulse 8s ease-in-out infinite;
    }

    @keyframes nebulaPulse {
        0%, 100% { opacity: 0.5; transform: scale(1); }
        50% { opacity: 0.8; transform: scale(1.1); }
    }

    /* Particle System */
    .particle {
        position: fixed;
        width: 2px;
        height: 2px;
        background: rgba(34, 211, 238, 0.8);
        border-radius: 50%;
        pointer-events: none;
        animation: particleFloat 15s infinite;
    }

    @keyframes particleFloat {
        0% { transform: translate(0, 100vh) scale(0); opacity: 0; }
        10% { opacity: 1; }
        90% { opacity: 1; }
        100% { transform: translate(var(--tx), -100vh) scale(1); opacity: 0; }
    }

    /* Holographic Card */
    .holo-card {
        background: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(30px);
        -webkit-backdrop-filter: blur(30px);
        border: 2px solid rgba(34, 211, 238, 0.3);
        box-shadow: 0 0 40px rgba(34, 211, 238, 0.2), inset 0 0 40px rgba(34, 211, 238, 0.05), 0 0 80px rgba(249, 115, 22, 0.1);
        position: relative;
        overflow: hidden;
    }

    .holo-card::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent 30%, rgba(34, 211, 238, 0.1) 50%, transparent 70%);
        animation: holoSweep 3s linear infinite;
    }

    @keyframes holoSweep {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Glitch Effect */
    .glitch {
        position: relative;
        animation: glitchMain 5s infinite;
    }

    @keyframes glitchMain {
        0%, 90%, 100% { transform: translate(0); }
        91% { transform: translate(-2px, 2px); }
        92% { transform: translate(2px, -2px); }
        93% { transform: translate(-2px, -2px); }
        94% { transform: translate(2px, 2px); }
        95% { transform: translate(0); }
    }

    /* Neon Text */
    .neon-text {
        font-family: 'Orbitron', sans-serif;
        text-transform: uppercase;
        background: linear-gradient(90deg, #22d3ee 0%, #06b6d4 25%, #F97316 50%, #FB923C 75%, #22d3ee 100%);
        background-size: 200% auto;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: neonGlow 3s linear infinite;
        filter: drop-shadow(0 0 20px rgba(34, 211, 238, 0.5));
    }

    @keyframes neonGlow {
        0%, 100% { background-position: 0% 50%; filter: drop-shadow(0 0 20px rgba(34, 211, 238, 0.5)); }
        50% { background-position: 100% 50%; filter: drop-shadow(0 0 30px rgba(249, 115, 22, 0.7)); }
    }

    /* Cyber Input */
    .cyber-input {
        background: rgba(34, 211, 238, 0.05);
        border: 2px solid rgba(34, 211, 238, 0.3);
        color: #22d3ee;
        font-family: 'Rajdhani', sans-serif;
        font-weight: 500;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        position: relative;
    }

    .cyber-input:focus {
        background: rgba(34, 211, 238, 0.1);
        border-color: #22d3ee;
        box-shadow: 0 0 20px rgba(34, 211, 238, 0.4), inset 0 0 20px rgba(34, 211, 238, 0.1);
        outline: none;
    }

    .cyber-input::placeholder {
        color: rgba(34, 211, 238, 0.4);
        font-family: 'Rajdhani', sans-serif;
    }

    /* Cyber Button */
    .cyber-button {
        background: linear-gradient(135deg, #22d3ee 0%, #06b6d4 100%);
        border: 2px solid #22d3ee;
        color: #000;
        font-family: 'Orbitron', sans-serif;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .cyber-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s;
    }

    .cyber-button:hover::before { left: 100%; }
    .cyber-button:hover {
        box-shadow: 0 0 30px rgba(34, 211, 238, 0.6), inset 0 0 20px rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
    }
    .cyber-button:active { transform: translateY(0); }

    /* Animated Border */
    @keyframes borderPulse {
        0%, 100% { border-color: rgba(34, 211, 238, 0.3); }
        50% { border-color: rgba(34, 211, 238, 0.8); }
    }

    .pulse-border { animation: borderPulse 2s ease-in-out infinite; }

    /* Floating Logo Container */
    .logo-container {
        width: 100px;
        height: 100px;
        position: relative;
        margin: 0 auto 20px;
        animation: logoFloat 3s ease-in-out infinite;
    }

    @keyframes logoFloat {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    /* Concentric Rings */
    .logo-ring {
        position: absolute;
        border-radius: 50%;
        border: 2px solid;
        animation: ringPulse 3s ease-in-out infinite;
    }

    .logo-ring:nth-child(1) { width: 100%; height: 100%; border-color: rgba(34, 211, 238, 0.4); animation-delay: 0s; }
    .logo-ring:nth-child(2) { width: 85%; height: 85%; top: 7.5%; left: 7.5%; border-color: rgba(249, 115, 22, 0.3); animation-delay: 0.3s; }
    .logo-ring:nth-child(3) { width: 70%; height: 70%; top: 15%; left: 15%; border-color: rgba(34, 211, 238, 0.2); animation-delay: 0.6s; }

    @keyframes ringPulse {
        0%, 100% { transform: scale(1); opacity: 0.6; }
        50% { transform: scale(1.1); opacity: 1; }
    }

    /* Logo Image Container */
    .logo-image {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 65px;
        height: 65px;
        border-radius: 50%;
        z-index: 10;
        box-shadow: 0 0 30px rgba(34, 211, 238, 0.6), 0 0 60px rgba(249, 115, 22, 0.3), inset 0 0 20px rgba(255, 255, 255, 0.1);
        border: 3px solid rgba(34, 211, 238, 0.5);
        overflow: hidden;
        animation: logoGlow 2s ease-in-out infinite;
    }

    @keyframes logoGlow {
        0%, 100% { box-shadow: 0 0 30px rgba(34, 211, 238, 0.6), 0 0 60px rgba(249, 115, 22, 0.3); border-color: rgba(34, 211, 238, 0.5); }
        50% { box-shadow: 0 0 40px rgba(34, 211, 238, 0.8), 0 0 80px rgba(249, 115, 22, 0.5); border-color: rgba(249, 115, 22, 0.7); }
    }

    .logo-image img { width: 100%; height: 100%; object-fit: cover; }

    /* Status Indicator */
    .status-pulse { animation: statusPulse 2s ease-in-out infinite; }

    @keyframes statusPulse {
        0%, 100% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7); opacity: 1; }
        50% { box-shadow: 0 0 0 10px rgba(34, 197, 94, 0); opacity: 0.8; }
    }

    /* Data Stream */
    .data-stream {
        position: fixed;
        font-family: 'Courier New', monospace;
        font-size: 12px;
        color: rgba(34, 211, 238, 0.3);
        white-space: nowrap;
        animation: streamFlow 10s linear infinite;
        pointer-events: none;
    }

    @keyframes streamFlow {
        0% { transform: translateX(100vw); }
        100% { transform: translateX(-100%); }
    }

    /* Corner Decorations */
    .corner-deco {
        position: fixed;
        width: 100px;
        height: 100px;
        border: 2px solid rgba(34, 211, 238, 0.3);
        pointer-events: none;
    }

    /* Loading Animation */
    .loading-bar {
        height: 2px;
        background: linear-gradient(90deg, transparent, #22d3ee, transparent);
        background-size: 200% 100%;
        animation: loadingSlide 1.5s ease-in-out infinite;
    }

    @keyframes loadingSlide {
        0% { background-position: -100% 0; }
        100% { background-position: 200% 0; }
    }

    /* Fade in animation */
    @keyframes fadeInScale {
        from { opacity: 0; transform: scale(0.9) translateY(20px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }

    .fade-in { animation: fadeInScale 0.6s ease forwards; }
    .delay-1 { animation-delay: 0.1s; opacity: 0; }
    .delay-2 { animation-delay: 0.2s; opacity: 0; }
    .delay-3 { animation-delay: 0.3s; opacity: 0; }
    .delay-4 { animation-delay: 0.4s; opacity: 0; }
    .delay-5 { animation-delay: 0.5s; opacity: 0; }
</style>

