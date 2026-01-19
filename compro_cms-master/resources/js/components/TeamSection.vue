<template>
  <section
    id="team"
    class="team-section-wrapper"
    @mouseenter="isPaused = true"
    @mouseleave="isPaused = false"
  >
    <!-- Header Area -->
    <div class="header-area">
      <div class="container">
        <div class="header-content">
          <div class="title-wrapper">
            <h2 class="section-title">
              Kenali Tim Kami
            </h2>
          </div>


          <!-- Navigation Controls -->
          <div class="nav-controls">
            <button
              @click="handlePrev"
              class="nav-btn"
            >
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
            </button>
            <button
              @click="handleNext"
              class="nav-btn"
            >
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Carousel Content -->
    <div
      class="carousel-wrapper"
      @mousedown="touchStart($event)"
      @mousemove="touchMove($event)"
      @mouseup="touchEnd"
      @mouseleave="handleMouseLeave"
      @touchstart="touchStart($event)"
      @touchmove="touchMove($event)"
      @touchend="touchEnd"
    >
      <div class="container">
        <div
          class="carousel-track"
          :style="trackStyle"
          @transitionend="handleTransitionEnd"
        >
          <div
            v-for="(member, index) in extendedMembers"
            :key="index"
            class="card-container"
            :style="getCardStyle(index)"
          >
            <div class="card-inner">
              <div class="image-wrapper">
                 <img
                  :src="'/uploads/member/' + member.image"
                  :alt="member.name"
                  class="card-image"
                  draggable="false"
                />
              </div>

              <div class="card-content">
                <h3 class="member-name">
                  {{ member.name }}
                </h3>
                <p class="member-role">
                  {{ member.role }}
                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- Pagination Dots -->
        <div class="pagination-dots">
          <span
            v-for="(dot, idx) in members"
            :key="idx"
            class="dot"
            :class="{ active: realIndex === idx }"
          ></span>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "TeamSection",
  props: {
    members: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      currentIndex: 0,
      isTransitioning: false,
      isPaused: false,
      isDragging: false,
      startPos: 0,
      currentTranslate: 0,
      autoplayInterval: null,
      windowWidth: typeof window !== 'undefined' ? window.innerWidth : 1200,
    };
  },
  computed: {
    extendedMembers() {
      // Create 3 sets for infinite loop
      return [...this.members, ...this.members, ...this.members];
    },
    realIndex() {
      return this.currentIndex % this.members.length;
    },
    trackStyle() {
      const isDesktop = this.windowWidth >= 1024;
      const isTablet = this.windowWidth >= 640 && this.windowWidth < 1024;
      
      let offset = 0; 
      let slideWidthPct = 100;
      
      if (isDesktop) {
          slideWidthPct = 33.333;
          offset = 33.333;
      } else if (isTablet) {
          slideWidthPct = 50;
          offset = 25;
      }
      
      const dragPx = this.currentTranslate;
      
      return {
        transform: `translateX(calc(-${this.currentIndex * slideWidthPct}% + ${offset}% + ${dragPx}px))`,
        transition: this.isTransitioning && !this.isDragging
          ? "transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)"
          : "none",
      };
    },
  },
  mounted() {
    this.currentIndex = this.members.length;
    this.startAutoplay();
    window.addEventListener('resize', this.handleResize);
    this.handleResize();
  },
  beforeDestroy() {
    this.stopAutoplay();
    window.removeEventListener('resize', this.handleResize);
  },
  watch: {
    isPaused(val) {
      if (val) this.stopAutoplay();
      else this.startAutoplay();
    },
    isDragging(val) {
      if (val) this.stopAutoplay();
      else if (!this.isPaused) this.startAutoplay();
    },
  },
  methods: {
    handleResize() {
        this.windowWidth = window.innerWidth;
    },
    startAutoplay() {
      this.stopAutoplay();
      this.autoplayInterval = setInterval(() => {
        this.handleNext();
      }, 4000);
    },
    stopAutoplay() {
      if (this.autoplayInterval) {
        clearInterval(this.autoplayInterval);
        this.autoplayInterval = null;
      }
    },
    handleNext() {
      if (this.isTransitioning) return;
      this.isTransitioning = true;
      this.currentIndex++;
    },
    handlePrev() {
      if (this.isTransitioning) return;
      this.isTransitioning = true;
      this.currentIndex--;
    },
    handleTransitionEnd() {
      this.isTransitioning = false;
      const len = this.members.length;

      // If reached end of 3rd set, jump to middle
      if (this.currentIndex >= len * 2) {
        this.currentIndex = this.currentIndex - len;
      }
      // If reached start of 1st set, jump to middle
      else if (this.currentIndex < len) {
        this.currentIndex = this.currentIndex + len;
      }
    },
    touchStart(event) {
      this.isDragging = true;
      this.isTransitioning = false;
      const x = event.touches ? event.touches[0].clientX : event.clientX;
      this.startPos = x;
    },
    touchMove(event) {
      if (!this.isDragging) return;
      const x = event.touches ? event.touches[0].clientX : event.clientX;
      this.currentTranslate = x - this.startPos;
    },
    touchEnd() {
      this.isDragging = false;
      const movedBy = this.currentTranslate;
      this.currentTranslate = 0; 
      // Threshold check (80px)
      if (movedBy < -80) {
        this.handleNext();
      } else if (movedBy > 80) {
        this.handlePrev();
      } else {
        this.isTransitioning = true;
      }
    },
    handleMouseLeave() {
        if (this.isDragging) this.touchEnd();
        this.isPaused = false;
    },
    getCardStyle(index) {
        const visualIndex = index - this.currentIndex;
        const absDistance = Math.abs(visualIndex);
        
        let opacity = 0.4;
        let blur = 1;
        let zIndex = 0;

        if (absDistance < 0.3) {
            opacity = 1;
            blur = 0;
            zIndex = 10;
        } else if (absDistance < 1.3) {
            const t = (absDistance - 0.3) / 1.0;
            opacity = 1 - (1 - 0.7) * t;
            blur = 0;
            zIndex = 5;
        }

        return {
            opacity: opacity,
            filter: `blur(${blur}px)`,
            transition: 'opacity 0.7s ease-out, filter 0.7s ease-out',
            zIndex: zIndex
        };
    }
  },
};
</script>

<style scoped>
.team-section-wrapper {
  position: relative;
  background-color: #082d49; /* Solid Deep Navy */
  font-family: 'Inter', sans-serif !important;
  overflow: hidden;
  padding: 100px 0;
}

.header-area {
  margin-bottom: 60px;
}

.container {
  margin-right: auto;
  margin-left: auto;
  padding-right: 15px;
  padding-left: 15px;
  max-width: 1200px;
}

.header-content {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  align-items: flex-start;
}

@media (min-width: 768px) {
  .header-content {
    flex-direction: row;
    align-items: flex-end;
  }
}

.title-wrapper {
  max-width: 700px;
}

.section-title {
  color: #fff;
  font-size: 42px;
  font-weight: 800;
  margin-bottom: 20px;
  line-height: 1.2;
  letter-spacing: -0.02em;
}

.section-desc {
  color: rgba(255, 255, 255, 0.7);
  font-size: 18px;
  line-height: 1.6;
  font-weight: 300;
}

.nav-controls {
  display: flex;
  gap: 15px;
  margin-top: 30px;
}

@media (min-width: 768px) {
  .nav-controls {
    margin-top: 0;
  }
}

.nav-btn {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.1);
  display: flex;
  align-items: center;
  justify-content: center;
  color: #ffffff; /* White for arrows */
  cursor: pointer;
  transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
  backdrop-filter: blur(10px);
}

.nav-btn:hover {
  background-color: #007bff; /* Corporate Blue Background on Hover */
  border-color: #007bff;
  color: #ffffff; /* White Arrow on Hover */
  transform: scale(1.1);
  box-shadow: 0 10px 20px rgba(0, 123, 255, 0.3);
}

.carousel-wrapper {
  position: relative;
  overflow: visible !important;
  cursor: grab;
}

.carousel-wrapper:active {
  cursor: grabbing;
}

.carousel-track {
  display: flex;
  align-items: center;
  width: 100%;
}

.card-container {
  flex-shrink: 0;
  width: 100%;
  padding: 20px 15px;
  box-sizing: border-box;
  perspective: 1000px;
}

@media (min-width: 640px) {
  .card-container {
    width: 50%;
  }
}

@media (min-width: 1024px) {
  .card-container {
    width: 33.333%;
  }
}

.card-inner {
  display: flex;
  flex-direction: column;
  background: rgba(255, 255, 255, 0.03);
  backdrop-filter: blur(5px);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 24px;
  overflow: hidden;
  height: 100%;
  transition: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
}

.card-container:hover .card-inner {
  transform: translateY(-10px);
  background: rgba(255, 255, 255, 0.06);
  border-color: rgba(29, 209, 161, 0.3);
  box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
}

.image-wrapper {
  position: relative;
  width: 100%;
  padding-top: 120%;
  overflow: hidden;
  background: #0d3654;
}

.card-image {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.8s ease;
  filter: grayscale(20%);
}

.card-container:hover .card-image {
  transform: scale(1.05);
  filter: grayscale(0%);
}

.card-content {
  padding: 30px 25px;
  text-align: center;
  background: linear-gradient(to bottom, transparent, rgba(0,0,0,0.2));
}

.member-name {
  font-size: 22px;
  font-weight: 700;
  color: #ffffff;
  margin-bottom: 8px;
  letter-spacing: -0.01em;
}

.member-role {
  font-size: 14px;
  font-weight: 500;
  color: #1DD1A1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}

.pagination-dots {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 50px;
  gap: 10px;
}

.dot {
  height: 6px;
  border-radius: 100px;
  background: rgba(255, 255, 255, 0.2);
  width: 6px;
  transition: all 0.4s ease;
}

.dot.active {
  width: 40px;
  background-color: #007bff; /* Corporate Blue for Active Dot */
}
</style>
