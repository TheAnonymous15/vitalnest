<?php
/**
 * Care Journey Animation
 * Doctor emerges from Vitalnest Hub, walks road, SWIMS across sea, continues to patient home
 */
?>

<style>
/* Animation Container */
.care-journey-wrapper {
  position: relative;
  width: 100%;
  padding: 0.5rem 0;
  margin-top: -3rem;
}

.care-desktop { display: none; }
.care-mobile { display: block; }

@media (min-width: 768px) {
  .care-desktop { display: block; }
  .care-mobile { display: none; }
}

/* Road 3D effect */
.road-3d {
  filter: drop-shadow(0 4px 8px rgba(0,0,0,0.3));
}

/* Water animation */
.water-wave {
  animation: waveMove 3s ease-in-out infinite;
}

@keyframes waveMove {
  0%, 100% { d: path("M280 140 Q320 130 360 140 Q400 150 440 140 Q480 130 520 140 Q560 150 600 140 L600 220 L280 220 Z"); }
  50% { d: path("M280 140 Q320 150 360 140 Q400 130 440 140 Q480 150 520 140 Q560 130 600 140 L600 220 L280 220 Z"); }
}

/* Footstep trail */
.footstep {
  fill: rgba(255,255,255,0.1);
  transition: all 0.4s ease;
}
.footstep.active {
  fill: #F97316;
  filter: drop-shadow(0 0 4px rgba(249,115,22,0.8));
}

/* Doctor walking animation */
#doctorGroup.walking .doctor-body {
  animation: doctorWalk 0.25s ease-in-out infinite;
  transition: transform 0.6s ease-in-out;
}

@keyframes doctorWalk {
  0%, 100% { transform: translateY(0) rotate(-2deg); }
  50% { transform: translateY(-3px) rotate(2deg); }
}

/* Smooth transition states for entering/exiting water */
#doctorGroup.entering-water .doctor-body {
  transform: rotate(45deg) translateY(-10px);
  transition: transform 0.5s ease-in-out;
}

#doctorGroup.exiting-water .doctor-body {
  transform: rotate(45deg) translateY(-10px);
  transition: transform 0.5s ease-in-out;
}

#doctorGroup.entering-water-reverse .doctor-body {
  transform: rotate(-45deg) translateY(-10px);
  transition: transform 0.5s ease-in-out;
}

#doctorGroup.exiting-water-reverse .doctor-body {
  transform: rotate(-45deg) translateY(-10px);
  transition: transform 0.5s ease-in-out;
}

/* Doctor swimming animation - Horizontal breast stroke, head facing forward */
#doctorGroup.swimming .doctor-body {
  transform: rotate(90deg) translateY(-20px);
  animation: doctorSwimBody 1.2s ease-in-out infinite;
  transition: transform 0.5s ease-in-out;
}

/* Doctor swimming REVERSE (head facing left/back to hub) */
#doctorGroup.swimming-reverse .doctor-body {
  transform: rotate(-90deg) translateY(-20px);
  animation: doctorSwimBodyReverse 1.2s ease-in-out infinite;
  transition: transform 0.5s ease-in-out;
}

@keyframes doctorSwimBody {
  0%, 100% { transform: rotate(90deg) translateY(-20px) translateX(0); }
  25% { transform: rotate(85deg) translateY(-20px) translateX(-4px); }
  50% { transform: rotate(90deg) translateY(-20px) translateX(0); }
  75% { transform: rotate(95deg) translateY(-20px) translateX(4px); }
}

@keyframes doctorSwimBodyReverse {
  0%, 100% { transform: rotate(-90deg) translateY(-20px) translateX(0); }
  25% { transform: rotate(-85deg) translateY(-20px) translateX(4px); }
  50% { transform: rotate(-90deg) translateY(-20px) translateX(0); }
  75% { transform: rotate(-95deg) translateY(-20px) translateX(-4px); }
}

/* Swimming arms - Breast stroke outward sweep */
#doctorGroup.swimming #leftArm,
#doctorGroup.swimming-reverse #leftArm {
  animation: breastStrokeLeft 1.2s ease-in-out infinite;
  transform-origin: -10px 3px;
}

#doctorGroup.swimming #rightArm,
#doctorGroup.swimming-reverse #rightArm {
  animation: breastStrokeRight 1.2s ease-in-out infinite;
  transform-origin: 10px 3px;
}

@keyframes breastStrokeLeft {
  0% { transform: rotate(80deg) translateY(-10px); }
  25% { transform: rotate(40deg) translateY(-5px) translateX(-8px); }
  50% { transform: rotate(-20deg) translateY(5px) translateX(-15px); }
  75% { transform: rotate(30deg) translateY(0) translateX(-5px); }
  100% { transform: rotate(80deg) translateY(-10px); }
}

@keyframes breastStrokeRight {
  0% { transform: rotate(-80deg) translateY(-10px); }
  25% { transform: rotate(-40deg) translateY(-5px) translateX(8px); }
  50% { transform: rotate(20deg) translateY(5px) translateX(15px); }
  75% { transform: rotate(-30deg) translateY(0) translateX(5px); }
  100% { transform: rotate(-80deg) translateY(-10px); }
}

/* Swimming legs - Frog kick */
#doctorGroup.swimming #leftLeg,
#doctorGroup.swimming-reverse #leftLeg {
  animation: frogKickLeft 1.2s ease-in-out infinite;
  transform-origin: -5px 16px;
}

#doctorGroup.swimming #rightLeg,
#doctorGroup.swimming-reverse #rightLeg {
  animation: frogKickRight 1.2s ease-in-out infinite;
  transform-origin: 5px 16px;
}

@keyframes frogKickLeft {
  0%, 100% { transform: rotate(20deg) translateY(0); }
  25% { transform: rotate(50deg) translateY(8px) translateX(-5px); }
  50% { transform: rotate(70deg) translateY(12px) translateX(-10px); }
  75% { transform: rotate(40deg) translateY(5px) translateX(-3px); }
}

@keyframes frogKickRight {
  0%, 100% { transform: rotate(-20deg) translateY(0); }
  25% { transform: rotate(-50deg) translateY(8px) translateX(5px); }
  50% { transform: rotate(-70deg) translateY(12px) translateX(10px); }
  75% { transform: rotate(-40deg) translateY(5px) translateX(3px); }
}

/* Water splash effect */
.splash {
  opacity: 0;
  animation: splashAnim 0.8s ease-out forwards;
}

@keyframes splashAnim {
  0% { opacity: 0; transform: scale(0.5) translateY(0); }
  50% { opacity: 1; transform: scale(1.2) translateY(-10px); }
  100% { opacity: 0; transform: scale(0.8) translateY(-20px); }
}

/* Swimming splash droplets */
#doctorGroup.swimming .swim-splash,
#doctorGroup.swimming-reverse .swim-splash {
  opacity: 1;
}

.swim-splash {
  opacity: 0;
  transition: opacity 0.3s ease;
}

.swim-droplet {
  animation: dropletSplash 0.8s ease-out infinite;
}

@keyframes dropletSplash {
  0% { transform: translateY(0) translateX(0) scale(1); opacity: 0.8; }
  50% { transform: translateY(-15px) translateX(var(--dx, 5px)) scale(0.8); opacity: 0.6; }
  100% { transform: translateY(-25px) translateX(var(--dx, 5px)) scale(0.4); opacity: 0; }
}

/* Doctor glow on arrival */
#doctorGroup.arrived {
  filter: drop-shadow(0 0 15px rgba(249,115,22,0.9));
}

/* Speech bubble animation */
.speech-bubble {
  animation: bubbleFloat 3s ease-in-out infinite;
}

@keyframes bubbleFloat {
  0%, 100% { transform: translateY(0) rotate(-1deg); }
  50% { transform: translateY(-5px) rotate(1deg); }
}

/* Hub door swing */
.hub-door-segment {
  transition: all 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55);
  transform-origin: center;
}

/* Progress dot active */
.progress-dot {
  fill: rgba(255,255,255,0.2);
  transition: all 0.4s ease;
}
.progress-dot.active {
  fill: #F97316;
  filter: drop-shadow(0 0 6px rgba(249,115,22,0.8));
}

/* Bubble rise animation */
.water-bubble {
  animation: bubbleRise 2s ease-in-out infinite;
}

@keyframes bubbleRise {
  0% { transform: translateY(0); opacity: 0.6; }
  100% { transform: translateY(-30px); opacity: 0; }
}


}
</style>

<!-- ======================== -->
<!-- DESKTOP ANIMATION -->
<!-- ======================== -->
<div class="care-desktop care-journey-wrapper">
<svg id="careJourneySVG" viewBox="0 0 900 280" width="100%" height="280" preserveAspectRatio="xMidYMid meet" style="overflow: visible;">

  <defs>
    <!-- Road gradient -->
    <linearGradient id="roadGradient" x1="0%" y1="0%" x2="0%" y2="100%">
      <stop offset="0%" style="stop-color:#4a4a4a"/>
      <stop offset="50%" style="stop-color:#3a3a3a"/>
      <stop offset="100%" style="stop-color:#2a2a2a"/>
    </linearGradient>

    <!-- Water gradients -->
    <linearGradient id="waterGradient" x1="0%" y1="0%" x2="0%" y2="100%">
      <stop offset="0%" style="stop-color:#0891b2"/>
      <stop offset="50%" style="stop-color:#0e7490"/>
      <stop offset="100%" style="stop-color:#155e75"/>
    </linearGradient>

    <linearGradient id="waterSurfaceGradient" x1="0%" y1="0%" x2="100%" y2="0%">
      <stop offset="0%" style="stop-color:rgba(6,182,212,0.8)"/>
      <stop offset="50%" style="stop-color:rgba(34,211,238,0.9)"/>
      <stop offset="100%" style="stop-color:rgba(6,182,212,0.8)"/>
    </linearGradient>

    <!-- Hub glow -->
    <radialGradient id="hubGlow" cx="50%" cy="50%">
      <stop offset="0%" style="stop-color:rgba(249,115,22,0.6)"/>
      <stop offset="100%" style="stop-color:transparent"/>
    </radialGradient>

    <!-- Home glow -->
    <radialGradient id="homeGlow" cx="50%" cy="50%">
      <stop offset="0%" style="stop-color:rgba(249,115,22,0.7)"/>
      <stop offset="100%" style="stop-color:transparent"/>
    </radialGradient>

    <!-- Doctor skin -->
    <radialGradient id="skinTone" cx="30%" cy="30%">
      <stop offset="0%" style="stop-color:#ffe8d6"/>
      <stop offset="100%" style="stop-color:#e6c9a8"/>
    </radialGradient>

    <!-- Clip path for water -->
    <clipPath id="waterClip">
      <rect x="280" y="120" width="320" height="100"/>
    </clipPath>
  </defs>

  <!-- ============================================ -->
  <!-- BACKGROUND -->
  <!-- ============================================ -->
  <rect x="0" y="0" width="900" height="280" fill="transparent"/>

  <!-- ============================================ -->
  <!-- FIRST ROAD SECTION (Hub to Sea) -->
  <!-- ============================================ -->
  <g class="road-3d">
    <!-- Road shadow -->
    <path d="M100 140 C150 140, 200 160, 280 160"
          stroke="rgba(0,0,0,0.4)" stroke-width="14" fill="none" stroke-linecap="round"
          transform="translate(2, 4)"/>
    <!-- Road base -->
    <path d="M100 140 C150 140, 200 160, 280 160"
          stroke="#1a1a1a" stroke-width="13" fill="none" stroke-linecap="round"/>
    <!-- Road surface -->
    <path d="M100 140 C150 140, 200 160, 280 160"
          stroke="url(#roadGradient)" stroke-width="11" fill="none" stroke-linecap="round"/>
    <!-- Road edge -->
    <path d="M100 140 C150 140, 200 160, 280 160"
          stroke="rgba(255,255,255,0.2)" stroke-width="12" fill="none" stroke-linecap="round"/>
    <path d="M100 140 C150 140, 200 160, 280 160"
          stroke="url(#roadGradient)" stroke-width="10" fill="none" stroke-linecap="round"/>
    <!-- Center line -->
    <path id="roadPath1" d="M100 140 C150 140, 200 160, 280 160"
          stroke="#FFD54F" stroke-width="2" fill="none" stroke-dasharray="12 8" stroke-linecap="round"/>
  </g>

  <!-- ============================================ -->
  <!-- SEA / WATER SECTION -->
  <!-- ============================================ -->
  <g id="seaSection">
    <!-- Sea bed shadow -->
    <ellipse cx="440" cy="210" rx="170" ry="20" fill="rgba(0,0,0,0.3)"/>

    <!-- Main water body -->
    <path d="M280 150 Q320 145 360 150 Q400 155 440 150 Q480 145 520 150 Q560 155 600 150 L600 210 Q520 220 440 215 Q360 210 280 215 Z"
          fill="url(#waterGradient)" opacity="0.9"/>

    <!-- Water surface waves -->
    <path class="water-wave" d="M280 145 Q320 135 360 145 Q400 155 440 145 Q480 135 520 145 Q560 155 600 145"
          stroke="url(#waterSurfaceGradient)" stroke-width="8" fill="none" stroke-linecap="round"/>

    <!-- Foam/highlights on waves -->
    <path d="M290 148 Q310 143 330 148" stroke="rgba(255,255,255,0.6)" stroke-width="2" fill="none"/>
    <path d="M380 145 Q400 140 420 145" stroke="rgba(255,255,255,0.6)" stroke-width="2" fill="none"/>
    <path d="M480 148 Q500 143 520 148" stroke="rgba(255,255,255,0.6)" stroke-width="2" fill="none"/>
    <path d="M550 145 Q570 140 590 145" stroke="rgba(255,255,255,0.6)" stroke-width="2" fill="none"/>

    <!-- Underwater bubbles (animated) -->
    <circle class="water-bubble" cx="320" cy="180" r="3" fill="rgba(255,255,255,0.4)" style="animation-delay: 0s;"/>
    <circle class="water-bubble" cx="400" cy="190" r="2" fill="rgba(255,255,255,0.3)" style="animation-delay: 0.5s;"/>
    <circle class="water-bubble" cx="480" cy="175" r="4" fill="rgba(255,255,255,0.4)" style="animation-delay: 1s;"/>
    <circle class="water-bubble" cx="540" cy="185" r="2" fill="rgba(255,255,255,0.3)" style="animation-delay: 1.5s;"/>
    <circle class="water-bubble" cx="360" cy="195" r="3" fill="rgba(255,255,255,0.35)" style="animation-delay: 0.7s;"/>
    <circle class="water-bubble" cx="520" cy="195" r="2" fill="rgba(255,255,255,0.3)" style="animation-delay: 1.2s;"/>

    <!-- Sea labels -->
    <text x="440" y="185" text-anchor="middle" fill="rgba(255,255,255,0.5)" font-size="10" font-weight="600">🌊 SEA 🌊</text>

    <!-- Swimming path (invisible, for motion) -->
    <path id="swimPath" d="M280 160 Q360 155 440 165 Q520 175 600 160"
          stroke="none" fill="none"/>
  </g>

  <!-- ============================================ -->
  <!-- SECOND ROAD SECTION (Sea to Home) -->
  <!-- ============================================ -->
  <g class="road-3d">
    <!-- Road shadow -->
    <path d="M600 160 C680 160, 720 140, 800 140"
          stroke="rgba(0,0,0,0.4)" stroke-width="14" fill="none" stroke-linecap="round"
          transform="translate(2, 4)"/>
    <!-- Road base -->
    <path d="M600 160 C680 160, 720 140, 800 140"
          stroke="#1a1a1a" stroke-width="13" fill="none" stroke-linecap="round"/>
    <!-- Road surface -->
    <path d="M600 160 C680 160, 720 140, 800 140"
          stroke="url(#roadGradient)" stroke-width="11" fill="none" stroke-linecap="round"/>
    <!-- Road edge -->
    <path d="M600 160 C680 160, 720 140, 800 140"
          stroke="rgba(255,255,255,0.2)" stroke-width="12" fill="none" stroke-linecap="round"/>
    <path d="M600 160 C680 160, 720 140, 800 140"
          stroke="url(#roadGradient)" stroke-width="10" fill="none" stroke-linecap="round"/>
    <!-- Center line -->
    <path id="roadPath2" d="M600 160 C680 160, 720 140, 800 140"
          stroke="#FFD54F" stroke-width="2" fill="none" stroke-dasharray="12 8" stroke-linecap="round"/>
  </g>

  <!-- ============================================ -->
  <!-- VITALNEST HUB -->
  <!-- ============================================ -->
  <g id="hubStation" transform="translate(60, 140)">
    <!-- Hub glow -->
    <circle id="hubGlowCircle" r="50" fill="url(#hubGlow)" opacity="0"/>

    <!-- Outer ring -->
    <circle id="hubOuterRing" r="38" fill="none" stroke="rgba(255,255,255,0.15)" stroke-width="2" stroke-dasharray="6 3"/>

    <!-- Main circle -->
    <circle r="32" fill="rgba(15,118,110,0.6)" stroke="rgba(255,255,255,0.3)" stroke-width="2"/>

    <!-- Main 3D circle with gradient -->
    <defs>
      <radialGradient id="hubMain3D">
        <stop offset="0%" style="stop-color:rgba(15,118,110,0.9)"/>
        <stop offset="70%" style="stop-color:rgba(15,118,110,0.7)"/>
        <stop offset="100%" style="stop-color:rgba(15,118,110,0.5)"/>
      </radialGradient>
      <radialGradient id="ringGradient">
        <stop offset="0%" style="stop-color:rgba(255,255,255,0.6)"/>
        <stop offset="100%" style="stop-color:rgba(15,118,110,0.8)"/>
      </radialGradient>
    </defs>
    <circle r="34" fill="url(#hubMain3D)" stroke="rgba(255,255,255,0.4)" stroke-width="2.5"/>

    <!-- 3D highlight -->
    <ellipse cx="-8" cy="-8" rx="20" ry="15" fill="rgba(255,255,255,0.15)" opacity="0.8"/>

    <!-- Inner door frame -->
    <circle r="26" fill="rgba(0,0,0,0.3)" stroke="rgba(255,255,255,0.25)" stroke-width="1.5"/>

    <!-- Enhanced door segments with 3D effect -->
    <g id="hubDoors">
      <!-- Top Left Door -->
      <path id="doorTopLeft" class="hub-door-segment" d="M0 -26 A26 26 0 0 0 -26 0 L0 0 Z"
            fill="url(#doorGradient1)" stroke="rgba(255,255,255,0.5)" stroke-width="1.5"/>
      <!-- Top Right Door -->
      <path id="doorTopRight" class="hub-door-segment" d="M0 -26 A26 26 0 0 1 26 0 L0 0 Z"
            fill="url(#doorGradient2)" stroke="rgba(255,255,255,0.5)" stroke-width="1.5"/>
      <!-- Bottom Left Door -->
      <path id="doorBottomLeft" class="hub-door-segment" d="M-26 0 A26 26 0 0 0 0 26 L0 0 Z"
            fill="url(#doorGradient3)" stroke="rgba(255,255,255,0.5)" stroke-width="1.5"/>
      <!-- Bottom Right Door -->
      <path id="doorBottomRight" class="hub-door-segment" d="M26 0 A26 26 0 0 0 0 26 L0 0 Z"
            fill="url(#doorGradient4)" stroke="rgba(255,255,255,0.5)" stroke-width="1.5"/>

      <!-- Door panel details -->
      <line x1="-13" y1="-13" x2="-8" y2="-8" stroke="rgba(255,255,255,0.3)" stroke-width="0.5"/>
      <line x1="13" y1="-13" x2="8" y2="-8" stroke="rgba(255,255,255,0.3)" stroke-width="0.5"/>
      <line x1="-13" y1="13" x2="-8" y2="8" stroke="rgba(255,255,255,0.3)" stroke-width="0.5"/>
      <line x1="13" y1="13" x2="8" y2="8" stroke="rgba(255,255,255,0.3)" stroke-width="0.5"/>

      <!-- Enhanced door handles with glow -->
      <g filter="url(#handleGlow)">
        <circle cx="-11" cy="-11" r="2.5" fill="rgba(249,115,22,0.9)" stroke="rgba(255,255,255,0.8)" stroke-width="1"/>
        <circle cx="11" cy="-11" r="2.5" fill="rgba(249,115,22,0.9)" stroke="rgba(255,255,255,0.8)" stroke-width="1"/>
        <circle cx="-11" cy="11" r="2.5" fill="rgba(249,115,22,0.9)" stroke="rgba(255,255,255,0.8)" stroke-width="1"/>
        <circle cx="11" cy="11" r="2.5" fill="rgba(249,115,22,0.9)" stroke="rgba(255,255,255,0.8)" stroke-width="1"/>
      </g>
    </g>

    <!-- Door gradients -->
    <defs>
      <linearGradient id="doorGradient1" x1="0%" y1="0%" x2="100%" y2="100%">
        <stop offset="0%" style="stop-color:rgba(15,118,110,1)"/>
        <stop offset="100%" style="stop-color:rgba(15,118,110,0.7)"/>
      </linearGradient>
      <linearGradient id="doorGradient2" x1="100%" y1="0%" x2="0%" y2="100%">
        <stop offset="0%" style="stop-color:rgba(15,118,110,1)"/>
        <stop offset="100%" style="stop-color:rgba(15,118,110,0.7)"/>
      </linearGradient>
      <linearGradient id="doorGradient3" x1="0%" y1="100%" x2="100%" y2="0%">
        <stop offset="0%" style="stop-color:rgba(15,118,110,1)"/>
        <stop offset="100%" style="stop-color:rgba(15,118,110,0.7)"/>
      </linearGradient>
      <linearGradient id="doorGradient4" x1="100%" y1="100%" x2="0%" y2="0%">
        <stop offset="0%" style="stop-color:rgba(15,118,110,1)"/>
        <stop offset="100%" style="stop-color:rgba(15,118,110,0.7)"/>
      </linearGradient>
      <filter id="handleGlow">
        <feGaussianBlur stdDeviation="1.5" result="coloredBlur"/>
        <feMerge>
          <feMergeNode in="coloredBlur"/>
          <feMergeNode in="SourceGraphic"/>
        </feMerge>
      </filter>
    </defs>

    <!-- Inner logo (revealed when doors open) -->
    <g id="hubInnerLogo" opacity="0">
      <circle r="18" fill="rgba(249,115,22,0.95)" stroke="rgba(255,255,255,0.6)" stroke-width="2">
        <animate attributeName="r" values="18;20;18" dur="2s" repeatCount="indefinite" begin="0s"/>
      </circle>
      <!-- Medical cross icon -->
      <path d="M-8 0 L-3 0 L-1 -6 L1 6 L3 0 L8 0" stroke="white" stroke-width="2.5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
      <circle cx="0" cy="0" r="2" fill="white"/>
    </g>

    <!-- Enhanced label with background -->
    <g transform="translate(0, 52)">
      <rect x="-38" y="-6" width="76" height="12" rx="6" fill="rgba(0,0,0,0.4)"/>
      <text y="2" text-anchor="middle" fill="rgba(255,255,255,0.95)" font-size="9" font-weight="700" letter-spacing="1">VITALNEST HUB</text>
    </g>
  </g>

  <!-- ============================================ -->
  <!-- PATIENT HOME -->
  <!-- ============================================ -->
  <g id="homeStation" transform="translate(840, 140)">
    <!-- Home glow -->
    <circle id="homeGlowCircle" r="45" fill="url(#homeGlow)" opacity="0"/>

    <!-- Outer ring -->
    <circle r="35" fill="none" stroke="rgba(255,255,255,0.15)" stroke-width="2"/>

    <!-- Main circle -->
    <circle r="28" fill="rgba(255,255,255,0.1)" stroke="rgba(255,255,255,0.3)" stroke-width="2"/>

    <!-- Inner circle -->
    <circle r="22" fill="rgba(249,115,22,0.15)" stroke="rgba(249,115,22,0.4)" stroke-width="1"/>

    <!-- Home icon -->
    <g transform="translate(0, -2)">
      <path d="M-12 3 L0 -10 L12 3" stroke="#0F766E" stroke-width="3" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
      <rect x="-9" y="1" width="18" height="14" fill="rgba(255,255,255,0.2)" stroke="#0F766E" stroke-width="2" rx="1"/>
      <rect x="-3" y="7" width="6" height="8" fill="#F97316" rx="1"/>
      <circle cx="2" cy="11" r="1" fill="white"/>
    </g>

    <!-- Label -->
    <text y="50" text-anchor="middle" fill="rgba(255,255,255,0.8)" font-size="9" font-weight="700" letter-spacing="0.5">YOUR HOME</text>

    <!-- Waiting patient -->
    <g transform="translate(30, -22)" opacity="0.7">
      <circle r="8" fill="rgba(255,255,255,0.1)" stroke="rgba(255,255,255,0.3)" stroke-width="1"/>
      <text y="3" text-anchor="middle" font-size="8">👴</text>
    </g>
  </g>

  <!-- ============================================ -->
  <!-- FOOTSTEPS CONTAINER -->
  <!-- ============================================ -->
  <g id="footsteps"></g>

  <!-- ============================================ -->
  <!-- SPLASH EFFECTS CONTAINER -->
  <!-- ============================================ -->
  <g id="splashEffects"></g>

<!-- ============================================ -->
  <!-- CROCODILE CHARACTER (head facing RIGHT, chasing doctor) -->
  <!-- ============================================ -->

  <!-- ============================================ -->
  <!-- DOCTOR CHARACTER -->
  <!-- ============================================ -->
  <g id="doctorGroup" opacity="0">
    <!-- Speech bubble -->
    <g id="speechBubble" class="speech-bubble" transform="translate(0, -65)">
      <rect x="-70" y="-18" width="140" height="30" rx="15" fill="rgba(255,255,255,0.97)" stroke="#0F766E" stroke-width="2"/>
      <polygon points="0,12 -8,22 8,22" fill="rgba(255,255,255,0.97)" stroke="#0F766E" stroke-width="1.5"/>
      <polygon points="-6,12 0,18 6,12" fill="rgba(255,255,255,0.97)"/>
      <text x="0" y="2" text-anchor="middle" fill="#0F766E" font-size="10" font-weight="700">
        "We cross lands AND seas!" 🏊
      </text>
    </g>

    <!-- Doctor figure -->
    <g class="doctor-body">
      <!-- Swimming splash droplets (visible only when swimming) -->
      <g class="swim-splash">
        <circle class="swim-droplet" cx="-20" cy="5" r="3" fill="rgba(34,211,238,0.8)" style="--dx: -8px; animation-delay: 0s;"/>
        <circle class="swim-droplet" cx="20" cy="5" r="3" fill="rgba(34,211,238,0.8)" style="--dx: 8px; animation-delay: 0.2s;"/>
        <circle class="swim-droplet" cx="-15" cy="-5" r="2" fill="rgba(34,211,238,0.7)" style="--dx: -12px; animation-delay: 0.4s;"/>
        <circle class="swim-droplet" cx="15" cy="-5" r="2" fill="rgba(34,211,238,0.7)" style="--dx: 12px; animation-delay: 0.6s;"/>
        <circle class="swim-droplet" cx="0" cy="15" r="2" fill="rgba(34,211,238,0.6)" style="--dx: 0px; animation-delay: 0.3s;"/>
        <circle class="swim-droplet" cx="-25" cy="10" r="2" fill="rgba(34,211,238,0.6)" style="--dx: -15px; animation-delay: 0.5s;"/>
        <circle class="swim-droplet" cx="25" cy="10" r="2" fill="rgba(34,211,238,0.6)" style="--dx: 15px; animation-delay: 0.7s;"/>
      </g>

      <!-- Shadow -->
      <ellipse id="doctorShadow" cx="0" cy="32" rx="12" ry="4" fill="rgba(0,0,0,0.2)"/>

      <!-- Left leg -->
      <g id="leftLeg" style="transform-origin: -5px 16px;">
        <line x1="-5" y1="16" x2="-8" y2="30" stroke="#2d2d2d" stroke-width="4" stroke-linecap="round"/>
        <ellipse cx="-9" cy="31" rx="4" ry="2" fill="#1a1a1a"/>
      </g>

      <!-- Right leg -->
      <g id="rightLeg" style="transform-origin: 5px 16px;">
        <line x1="5" y1="16" x2="8" y2="30" stroke="#2d2d2d" stroke-width="4" stroke-linecap="round"/>
        <ellipse cx="9" cy="31" rx="4" ry="2" fill="#1a1a1a"/>
      </g>

      <!-- Lab coat body -->
      <path d="M-10 0 L-11 16 L11 16 L10 0 Z" fill="white" stroke="#e8e8e8" stroke-width="0.5"/>
      <line x1="0" y1="2" x2="0" y2="14" stroke="#e0e0e0" stroke-width="0.5"/>
      <circle cx="0" cy="5" r="1.5" fill="#0F766E"/>
      <circle cx="0" cy="9" r="1.5" fill="#0F766E"/>
      <circle cx="0" cy="13" r="1.5" fill="#0F766E"/>

      <!-- Left arm -->
      <g id="leftArm" style="transform-origin: -10px 3px;">
        <line x1="-10" y1="3" x2="-17" y2="12" stroke="#f5f5f5" stroke-width="4" stroke-linecap="round"/>
        <circle cx="-18" cy="13" r="3" fill="url(#skinTone)"/>
      </g>

      <!-- Right arm with medical bag -->
      <g id="rightArm" style="transform-origin: 10px 3px;">
        <line x1="10" y1="3" x2="17" y2="10" stroke="#f5f5f5" stroke-width="4" stroke-linecap="round"/>
        <circle cx="18" cy="11" r="3" fill="url(#skinTone)"/>
        <!-- Medical bag -->
        <g transform="translate(20, 14)">
          <rect x="-5" y="-4" width="10" height="8" rx="2" fill="#F97316" stroke="#c2410c" stroke-width="0.5"/>
          <line x1="0" y1="-2" x2="0" y2="2" stroke="white" stroke-width="2"/>
          <line x1="-2" y1="0" x2="2" y2="0" stroke="white" stroke-width="2"/>
        </g>
      </g>

      <!-- Neck -->
      <rect x="-3" y="-6" width="6" height="7" fill="url(#skinTone)"/>

      <!-- Stethoscope -->
      <path d="M-4 0 Q-7 5 -4 10" stroke="#0F766E" stroke-width="2" fill="none"/>
      <circle cx="-4" cy="11" r="2.5" fill="#0F766E"/>

      <!-- Head -->
      <ellipse cx="0" cy="-14" rx="10" ry="11" fill="url(#skinTone)" stroke="#d4a574" stroke-width="0.5"/>

      <!-- Hair -->
      <path d="M-8 -22 Q0 -27 8 -22 Q10 -17 9 -14 L9 -18 Q0 -23 -9 -18 L-9 -14 Q-10 -17 -8 -22" fill="#2d2d2d"/>

      <!-- Eyes -->
      <ellipse cx="-4" cy="-15" rx="2" ry="2.5" fill="white"/>
      <ellipse cx="4" cy="-15" rx="2" ry="2.5" fill="white"/>
      <circle cx="-4" cy="-15" r="1.2" fill="#3d3d3d"/>
      <circle cx="4" cy="-15" r="1.2" fill="#3d3d3d"/>

      <!-- Smile -->
      <path d="M-3 -8 Q0 -5 3 -8" stroke="#b8846a" stroke-width="1" fill="none" stroke-linecap="round"/>

      <!-- ID Badge -->
      <g transform="translate(5, 2)">
        <rect x="-3" y="-2" width="6" height="7" rx="1" fill="white" stroke="#ddd" stroke-width="0.5"/>
        <rect x="-2" y="-1" width="4" height="3" fill="#0F766E"/>
      </g>
    </g>
  </g>

  <!-- ============================================ -->
  <!-- PROGRESS INDICATORS -->
  <!-- ============================================ -->
  <g id="progressDots" transform="translate(250, 260)">
    <circle class="progress-dot" cx="0" cy="0" r="5"/>
    <circle class="progress-dot" cx="100" cy="0" r="5"/>
    <circle class="progress-dot" cx="200" cy="0" r="5"/>
    <circle class="progress-dot" cx="300" cy="0" r="5"/>
    <circle class="progress-dot" cx="400" cy="0" r="5"/>
  </g>

  <!-- Journey description -->
  <text x="450" y="275" text-anchor="middle" fill="rgba(255,255,255,0.4)" font-size="9" font-weight="500">
    We go the extra mile — across land and sea — to bring care to your doorstep
  </text>

  <!-- ============================================ -->
  <!-- STATUS CAPTIONS -->
  <!-- ============================================ -->
  <text id="captionDispatch" opacity="0" x="60" y="75" text-anchor="middle" fill="rgba(255,255,255,0.95)" font-size="11" font-weight="700">
    🏥 Doctor Dispatched!
  </text>

  <text id="captionSwimming" opacity="0" x="440" y="240" text-anchor="middle" fill="rgba(255,255,255,0.9)" font-size="11" font-weight="600">
    🏊 Swimming across!
  </text>

  <text id="captionCare" opacity="0" x="840" y="75" text-anchor="middle" fill="rgba(255,255,255,0.95)" font-size="11" font-weight="700">
    💚 Care Delivered!
  </text>

</svg>
</div>

<!-- ======================== -->
<!-- MOBILE FALLBACK -->
<!-- ======================== -->
<div class="care-mobile text-center py-6 px-4">
  <div class="flex items-center justify-center gap-2 mb-4">
    <!-- Hub -->
    <div class="relative w-14 h-14 rounded-full bg-gradient-to-br from-vital-teal/30 to-vital-teal/10 border-2 border-white/20 flex items-center justify-center">
      <div class="w-8 h-8 bg-vital-orange/90 rounded-lg flex items-center justify-center">
        <i class="fas fa-heartbeat text-white text-sm"></i>
      </div>
    </div>

    <!-- Road -->
    <div class="w-8 h-1.5 bg-gray-600 rounded"></div>

    <!-- Sea -->
    <div class="w-12 h-6 bg-gradient-to-b from-cyan-400 to-cyan-600 rounded flex items-center justify-center">
      <span class="text-xs">🏊</span>
    </div>

    <!-- Road -->
    <div class="w-8 h-1.5 bg-gray-600 rounded"></div>

    <!-- Home -->
    <div class="relative w-14 h-14 rounded-full bg-white/10 border-2 border-white/20 flex items-center justify-center">
      <i class="fas fa-home text-vital-orange text-lg"></i>
    </div>
  </div>

  <p class="text-white/85 text-xs font-semibold">We cross lands AND seas for you!</p>
  <p class="text-white/50 text-[10px]">Professional • Personal • Unstoppable</p>
</div>

<!-- ======================== -->
<!-- GSAP ANIMATION LOGIC -->
<!-- ======================== -->
<script>
document.addEventListener("DOMContentLoaded", () => {
  if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined' || typeof MotionPathPlugin === 'undefined') {
    console.warn('GSAP or plugins not loaded');
    return;
  }

  gsap.registerPlugin(ScrollTrigger, MotionPathPlugin);

  const doctorGroup = document.querySelector("#doctorGroup");
  const speechBubble = document.querySelector("#speechBubble");
  const doctorShadow = document.querySelector("#doctorShadow");
  const dots = gsap.utils.toArray(".progress-dot");

  // Door elements
  const doorTopLeft = document.querySelector("#doorTopLeft");
  const doorTopRight = document.querySelector("#doorTopRight");
  const doorBottomLeft = document.querySelector("#doorBottomLeft");
  const doorBottomRight = document.querySelector("#doorBottomRight");

  const hubInnerLogo = document.querySelector("#hubInnerLogo");
  const hubGlowCircle = document.querySelector("#hubGlowCircle");
  const hubOuterRing = document.querySelector("#hubOuterRing");
  const homeGlowCircle = document.querySelector("#homeGlowCircle");

  if (!doctorGroup) return;

  // Initial state
  gsap.set(doctorGroup, { x: 60, y: 140, scale: 0.15, opacity: 0 });
  gsap.set(speechBubble, { opacity: 0, scale: 0 });

  // Rotate hub ring
  gsap.to(hubOuterRing, {
    rotation: 360,
    duration: 15,
    repeat: -1,
    ease: "none",
    transformOrigin: "center center"
  });

  // Main timeline
  const tl = gsap.timeline({
    scrollTrigger: {
      trigger: "#careJourneySVG",
      start: "top 85%",
      once: true
    }
  });

  // ====== PHASE 1: Hub opens ======
  tl.to(hubGlowCircle, { opacity: 1, scale: 1.2, duration: 0.5 });

  // Doors open
  tl.to(doorTopLeft, { rotation: -40, x: -10, y: -10, opacity: 0.3, duration: 0.6, ease: "back.out(1.5)" }, "-=0.2");
  tl.to(doorTopRight, { rotation: 40, x: 10, y: -10, opacity: 0.3, duration: 0.6, ease: "back.out(1.5)" }, "<");
  tl.to(doorBottomLeft, { rotation: 40, x: -10, y: 10, opacity: 0.3, duration: 0.6, ease: "back.out(1.5)" }, "<");
  tl.to(doorBottomRight, { rotation: -40, x: 10, y: 10, opacity: 0.3, duration: 0.6, ease: "back.out(1.5)" }, "<");

  // Logo reveals
  tl.to(hubInnerLogo, { opacity: 1, scale: 1.1, duration: 0.3 }, "-=0.3");

  // ====== PHASE 2: Doctor emerges ======
  tl.to(doctorGroup, { opacity: 1, scale: 0.5, duration: 0.4, ease: "back.out(2)" });
  tl.to(doctorGroup, { x: 100, y: 140, scale: 0.8, duration: 0.5, ease: "power2.out" });

  // Speech bubble
  tl.to(speechBubble, { opacity: 1, scale: 1, duration: 0.3, ease: "back.out(2)" });

  // Doors close
  tl.to([doorTopLeft, doorTopRight, doorBottomLeft, doorBottomRight], {
    rotation: 0, x: 0, y: 0, opacity: 1, duration: 0.5, ease: "power2.inOut"
  });
  tl.to(hubInnerLogo, { opacity: 0, duration: 0.2 }, "<");
  tl.to(hubGlowCircle, { opacity: 0.2, duration: 0.3 }, "<");

  // Dispatch caption
  tl.to("#captionDispatch", { opacity: 1, duration: 0.3 });

  // Start walking
  tl.call(() => { doctorGroup.classList.add("walking"); });

  // Progress dot 1
  tl.to(dots[0], { fill: "#F97316", scale: 1.2, duration: 0.2 });

  // ====== PHASE 3: Walk first road ======
  tl.to(doctorGroup, {
    duration: 2.5,
    ease: "none",
    motionPath: {
      path: "#roadPath1",
      align: "#roadPath1",
      alignOrigin: [0.5, 0.5],
      start: 0,
      end: 1
    }
  });

  // Progress dot 2
  tl.to(dots[1], { fill: "#F97316", scale: 1.2, duration: 0.2 }, "-=1");

  // Hide dispatch caption
  tl.to("#captionDispatch", { opacity: 0, duration: 0.2 });

  // ====== PHASE 4: Enter water - Transition to swimming ======
  // First, transition pose (diving in)
  tl.call(() => {
    doctorGroup.classList.remove("walking");
    doctorGroup.classList.add("entering-water");
    gsap.to(doctorShadow, { opacity: 0, duration: 0.3 });
  });

  // Wait for transition
  tl.to({}, { duration: 0.5 });

  // Now start swimming
  tl.call(() => {
    doctorGroup.classList.remove("entering-water");
    doctorGroup.classList.add("swimming");
  });

  // Swimming caption
  tl.to("#captionSwimming", { opacity: 1, duration: 0.3 });

  // Swim FIRST HALF of sea (normal pace)
  tl.to(doctorGroup, {
    duration: 2,
    ease: "none",
    motionPath: {
      path: "#swimPath",
      align: "#swimPath",
      alignOrigin: [0.5, 0.5],
      start: 0,
      end: 0.4
    }
  });

  // Progress dot 3 (middle of swim)
  tl.to(dots[2], { fill: "#F97316", scale: 1.2, duration: 0.2 }, "-=1");

  // ====== PHASE 4.5: Continue swimming (second half) ======
  // Doctor continues swimming across sea
  tl.to(doctorGroup, {
    duration: 2,
    ease: "none",
    motionPath: {
      path: "#swimPath",
      align: "#swimPath",
      alignOrigin: [0.5, 0.5],
      start: 0.4,
      end: 1
    }
  });

  // ====== PHASE 5: Exit water - Transition from swimming to walking ======
  // First, transition pose (climbing out)
  tl.call(() => {
    doctorGroup.classList.remove("swimming");
    doctorGroup.classList.add("exiting-water");
  });

  // Wait for transition
  tl.to({}, { duration: 0.5 });

  // Now start walking
  tl.call(() => {
    doctorGroup.classList.remove("exiting-water");
    doctorGroup.classList.add("walking");
    gsap.to(doctorShadow, { opacity: 0.2, duration: 0.3 });
  });


  // Progress dot 4
  tl.to(dots[3], { fill: "#F97316", scale: 1.2, duration: 0.2 });

  // ====== PHASE 6: Walk second road to home ======
  tl.to(doctorGroup, {
    duration: 2.5,
    ease: "none",
    motionPath: {
      path: "#roadPath2",
      align: "#roadPath2",
      alignOrigin: [0.5, 0.5],
      start: 0,
      end: 1
    }
  });

  // Progress dot 5
  tl.to(dots[4], { fill: "#F97316", scale: 1.2, duration: 0.2 }, "-=1");

  // ====== PHASE 7: Arrival ======
  tl.call(() => {
    doctorGroup.classList.remove("walking");
    doctorGroup.classList.add("arrived");
  });

  // Home glows
  tl.to(homeGlowCircle, { opacity: 1, scale: 1.2, duration: 0.5, ease: "power2.out" });

  // Care delivered
  tl.to("#captionCare", { opacity: 1, duration: 0.4 }, "<");

  // Hide speech bubble
  tl.to(speechBubble, { opacity: 0, scale: 0.8, duration: 0.2 });

  // ====== PAUSE ======
  tl.to({}, { duration: 2 });

  // ====== PHASE 8: Return journey ======
  tl.to("#captionCare", { opacity: 0, duration: 0.2 });
  tl.to(homeGlowCircle, { opacity: 0, duration: 0.2 }, "<");

  tl.call(() => {
    doctorGroup.classList.remove("arrived");
    doctorGroup.classList.add("walking");
  });

  tl.to(speechBubble, { opacity: 1, scale: 1, duration: 0.2 });

  // Walk back on road 2
  tl.to(doctorGroup, {
    duration: 2,
    ease: "none",
    motionPath: {
      path: "#roadPath2",
      align: "#roadPath2",
      alignOrigin: [0.5, 0.5],
      start: 1,
      end: 0
    }
  });

  // Transition into water (reverse direction)
  tl.call(() => {
    doctorGroup.classList.remove("walking");
    doctorGroup.classList.add("entering-water-reverse");
    gsap.to(doctorShadow, { opacity: 0, duration: 0.3 });
  });

  // Wait for transition
  tl.to({}, { duration: 0.5 });

  // Swim back (facing left - toward hub)
  tl.call(() => {
    doctorGroup.classList.remove("entering-water-reverse");
    doctorGroup.classList.add("swimming-reverse");
  });

  tl.to(doctorGroup, {
    duration: 3,
    ease: "none",
    motionPath: {
      path: "#swimPath",
      align: "#swimPath",
      alignOrigin: [0.5, 0.5],
      start: 1,
      end: 0
    }
  });

  // Transition out of water
  tl.call(() => {
    doctorGroup.classList.remove("swimming-reverse");
    doctorGroup.classList.add("exiting-water-reverse");
  });

  // Wait for transition
  tl.to({}, { duration: 0.5 });

  // Exit water, walk
  tl.call(() => {
    doctorGroup.classList.remove("exiting-water-reverse");
    doctorGroup.classList.add("walking");
    gsap.to(doctorShadow, { opacity: 0.2, duration: 0.3 });
  });

  // Walk back on road 1
  tl.to(doctorGroup, {
    duration: 2,
    ease: "none",
    motionPath: {
      path: "#roadPath1",
      align: "#roadPath1",
      alignOrigin: [0.5, 0.5],
      start: 1,
      end: 0
    }
  });

  // ====== PHASE 9: Return to hub ======
  tl.call(() => { doctorGroup.classList.remove("walking"); });
  tl.to(speechBubble, { opacity: 0, duration: 0.15 });
  tl.to(hubGlowCircle, { opacity: 1, duration: 0.2 });

  // Doors open
  tl.to([doorTopLeft, doorBottomLeft], { rotation: -40, x: -10, opacity: 0.3, duration: 0.4 });
  tl.to([doorTopRight, doorBottomRight], { rotation: 40, x: 10, opacity: 0.3, duration: 0.4 }, "<");

  // Doctor enters
  tl.to(doctorGroup, { x: 60, y: 140, scale: 0.15, opacity: 0, duration: 0.4, ease: "power2.in" });

  // Doors close
  tl.to([doorTopLeft, doorTopRight, doorBottomLeft, doorBottomRight], {
    rotation: 0, x: 0, y: 0, opacity: 1, duration: 0.4
  });
  tl.to(hubGlowCircle, { opacity: 0, duration: 0.2 }, "<");

  // Reset dots
  tl.to(dots, { fill: "rgba(255,255,255,0.2)", scale: 1, duration: 0.3, stagger: 0.05 });
});
</script>

