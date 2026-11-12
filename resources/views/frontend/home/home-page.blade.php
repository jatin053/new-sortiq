@extends('layouts.frontend')

@section('title', 'Sortiq Solutions Pvt. Ltd.')
@section('body_attributes') data-route="/" @endsection

@push('head')
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap">
      <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
      <noscript>
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">
      </noscript>
      <style>
        .sq-hero-slider {
          position: relative;
          width: 100%;
          min-height: 560px;
          background: linear-gradient(135deg, #00102b 0%, #00173e 50%, #002561 100%);
          color: #ffffff;
          overflow: hidden;
          display: flex;
          flex-direction: column;
          justify-content: center;
        }
        .sq-hero-slider::before {
          content: '';
          position: absolute;
          inset: 0;
          background-image: radial-gradient(rgba(255, 255, 255, 0.08) 1px, transparent 1px);
          background-size: 28px 28px;
          opacity: 0.65;
          pointer-events: none;
        }
        .sq-hero-glow-1 {
          position: absolute;
          top: -20%;
          right: -5%;
          width: 480px;
          height: 480px;
          border-radius: 50%;
          background: radial-gradient(circle, rgba(255, 102, 0, 0.16) 0%, transparent 70%);
          filter: blur(60px);
          pointer-events: none;
        }
        .sq-hero-glow-2 {
          position: absolute;
          bottom: -20%;
          left: -5%;
          width: 480px;
          height: 480px;
          border-radius: 50%;
          background: radial-gradient(circle, rgba(0, 140, 255, 0.14) 0%, transparent 70%);
          filter: blur(60px);
          pointer-events: none;
        }
        .sq-hero-track {
          display: flex;
          width: 100%;
          transition: transform 0.6s cubic-bezier(0.25, 1, 0.35, 1);
          will-change: transform;
        }
        .sq-hero-slide {
          flex: 0 0 100%;
          width: 100%;
          box-sizing: border-box;
          padding: 55px 24px 75px;
          display: flex;
          align-items: center;
          justify-content: center;
        }
        .sq-hero-container {
          max-width: 1240px;
          width: 100%;
          margin: 0 auto;
          display: grid;
          grid-template-columns: 1.15fr 0.85fr;
          gap: 48px;
          align-items: center;
          position: relative;
          z-index: 2;
        }
        .sq-hero-badge {
          display: inline-flex;
          align-items: center;
          gap: 8px;
          background: rgba(255, 102, 0, 0.12);
          border: 1px solid rgba(255, 102, 0, 0.32);
          color: #ff8533;
          font-size: 11.5px;
          font-weight: 700;
          letter-spacing: 1px;
          text-transform: uppercase;
          padding: 6px 14px;
          border-radius: 30px;
          margin-bottom: 16px;
          backdrop-filter: blur(4px);
        }
        .sq-hero-badge-pulse {
          width: 7px;
          height: 7px;
          border-radius: 50%;
          background: #ff6600;
          box-shadow: 0 0 8px #ff6600;
          animation: sqHeroPulse 2s infinite;
        }
        @keyframes sqHeroPulse {
          0%, 100% { opacity: 1; transform: scale(1); }
          50% { opacity: 0.4; transform: scale(0.8); }
        }
        .sq-hero-title {
          font-size: 42px;
          line-height: 1.2;
          font-weight: 800;
          color: #ffffff;
          margin: 0 0 16px;
          font-family: 'Raleway', sans-serif;
          letter-spacing: -0.5px;
        }
        .sq-hero-title span {
          background: linear-gradient(135deg, #ff8533 0%, #ff5a00 100%);
          -webkit-background-clip: text;
          -webkit-text-fill-color: transparent;
        }
        .sq-hero-desc {
          font-size: 16px;
          line-height: 1.65;
          color: #cbd5e1;
          margin: 0 0 24px;
          max-width: 580px;
        }
        .sq-hero-actions {
          display: flex;
          gap: 14px;
          align-items: center;
          flex-wrap: wrap;
          margin-bottom: 24px;
        }
        .sq-hero-btn-primary {
          background: #ff6600;
          color: #ffffff !important;
          font-size: 14px;
          font-weight: 600;
          letter-spacing: 0.4px;
          padding: 12px 28px;
          border-radius: 999px;
          text-decoration: none;
          display: inline-flex;
          align-items: center;
          gap: 8px;
          box-shadow: 0 4px 14px rgba(255, 102, 0, 0.35);
          transition: all 0.25s ease;
          border: none;
        }
        .sq-hero-btn-primary:hover {
          transform: translateY(-2px);
          box-shadow: 0 6px 18px rgba(0, 27, 67, 0.3);
          background: #001b43 !important;
        }
        .sq-hero-btn-outline {
          background: rgba(255, 255, 255, 0.06);
          border: 1px solid rgba(255, 255, 255, 0.25);
          color: #ffffff !important;
          font-size: 14px;
          font-weight: 600;
          padding: 12px 26px;
          border-radius: 999px;
          text-decoration: none;
          display: inline-flex;
          align-items: center;
          gap: 6px;
          backdrop-filter: blur(8px);
          transition: all 0.25s ease;
        }
        .sq-hero-btn-outline:hover {
          background: rgba(255, 255, 255, 0.16);
          border-color: rgba(255, 255, 255, 0.45);
          transform: translateY(-2px);
        }
        .sq-hero-pills {
          display: flex;
          flex-wrap: wrap;
          gap: 10px;
        }
        .sq-hero-pill {
          background: rgba(255, 255, 255, 0.04);
          border: 1px solid rgba(255, 255, 255, 0.08);
          color: #94a3b8;
          font-size: 12px;
          font-weight: 600;
          padding: 5px 12px;
          border-radius: 20px;
          display: inline-flex;
          align-items: center;
          gap: 6px;
        }
        /* Visual Stage on Right */
        .sq-hero-visual {
          position: relative;
          display: flex;
          justify-content: center;
          align-items: center;
          width: 100%;
        }
        .sq-tech-stage {
          position: relative;
          width: 100%;
          max-width: 520px;
        }
        .sq-tech-board {
          position: relative;
          background: rgba(3, 11, 28, 0.88);
          border: 1px solid rgba(0, 210, 255, 0.22);
          border-radius: 20px;
          padding: 20px;
          box-shadow: 0 25px 60px rgba(0, 0, 0, 0.65), inset 0 1px 0 rgba(255, 255, 255, 0.12), 0 0 35px rgba(0, 110, 255, 0.12);
          backdrop-filter: blur(16px);
          -webkit-backdrop-filter: blur(16px);
          overflow: hidden;
        }
        .sq-tech-board::before {
          content: '';
          position: absolute;
          top: 0;
          left: 0;
          right: 0;
          height: 2px;
          background: linear-gradient(90deg, transparent, #ff6600, #00d2ff, transparent);
        }
        .sq-board-header {
          display: flex;
          align-items: center;
          justify-content: space-between;
          padding-bottom: 12px;
          border-bottom: 1px solid rgba(255, 255, 255, 0.08);
          margin-bottom: 16px;
        }
        .sq-board-dots {
          display: flex;
          gap: 6px;
        }
        .sq-board-dot {
          width: 10px;
          height: 10px;
          border-radius: 50%;
        }
        .sq-board-dot.d-red { background: #ff5f56; box-shadow: 0 0 6px rgba(255, 95, 86, 0.6); }
        .sq-board-dot.d-yellow { background: #ffbd2e; box-shadow: 0 0 6px rgba(255, 189, 46, 0.6); }
        .sq-board-dot.d-green { background: #27c93f; box-shadow: 0 0 6px rgba(39, 201, 63, 0.6); }
        .sq-board-title-tag {
          font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
          font-size: 11.5px;
          color: #38bdf8;
          letter-spacing: 0.5px;
          display: inline-flex;
          align-items: center;
          gap: 6px;
        }
        .sq-live-badge {
          display: inline-flex;
          align-items: center;
          gap: 5px;
          background: rgba(34, 197, 94, 0.15);
          border: 1px solid rgba(34, 197, 94, 0.35);
          color: #4ade80;
          font-size: 10.5px;
          font-weight: 700;
          padding: 3px 9px;
          border-radius: 12px;
          text-transform: uppercase;
          letter-spacing: 0.5px;
        }
        .sq-live-dot {
          width: 6px;
          height: 6px;
          border-radius: 50%;
          background: #22c55e;
          animation: sqLivePulse 1.8s infinite;
        }
        @keyframes sqLivePulse {
          0%, 100% { opacity: 1; transform: scale(1); }
          50% { opacity: 0.3; transform: scale(0.7); }
        }

        /* Code Terminal */
        .sq-code-terminal {
          font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
          font-size: 12px;
          line-height: 1.7;
          color: #cbd5e1;
          background: rgba(0, 6, 20, 0.9);
          border: 1px solid rgba(255, 255, 255, 0.08);
          border-radius: 12px;
          padding: 14px 16px;
          margin-bottom: 14px;
          min-height: 154px;
          box-sizing: border-box;
          white-space: pre-wrap;
          word-break: break-word;
        }
        .c-kw { color: #c084fc; font-weight: 600; }
        .c-fn { color: #38bdf8; }
        .c-cls { color: #fbbf24; font-weight: 600; }
        .c-str { color: #4ade80; }
        .c-var { color: #93c5fd; }
        .c-tag { color: #f43f5e; font-weight: 600; }
        .c-res { color: #ff8533; font-weight: 600; }
        .c-cursor {
          display: inline-block;
          width: 7px;
          height: 14px;
          background: #ff8533;
          margin-left: 2px;
          vertical-align: middle;
          animation: sqCursorBlink 1s infinite;
        }
        .c-cursor.typing {
          animation: none !important;
          opacity: 1 !important;
        }
        @keyframes sqCursorBlink { 0%, 100% { opacity: 1; } 50% { opacity: 0; } }

        /* Telemetry Grid */
        .sq-telemetry-grid {
          display: grid;
          grid-template-columns: repeat(3, 1fr);
          gap: 10px;
        }
        .sq-telemetry-item {
          background: rgba(255, 255, 255, 0.03);
          border: 1px solid rgba(255, 255, 255, 0.08);
          border-radius: 10px;
          padding: 10px 8px;
          text-align: center;
        }
        .sq-telemetry-val {
          font-size: 15px;
          font-weight: 800;
          color: #ffffff;
          display: block;
          font-family: 'Raleway', sans-serif;
        }
        .sq-telemetry-val.c-orange { color: #ff8533; }
        .sq-telemetry-val.c-green { color: #4ade80; }
        .sq-telemetry-val.c-blue { color: #38bdf8; }
        .sq-telemetry-label {
          font-size: 10px;
          color: #94a3b8;
          display: block;
          margin-top: 2px;
          font-weight: 600;
          text-transform: uppercase;
          letter-spacing: 0.5px;
        }

        /* Floating Badges */
        .sq-float-badge {
          position: absolute;
          background: rgba(0, 18, 50, 0.94);
          border: 1px solid rgba(255, 255, 255, 0.18);
          box-shadow: 0 12px 30px rgba(0, 0, 0, 0.5), 0 0 20px rgba(0, 210, 255, 0.15);
          border-radius: 12px;
          padding: 8px 14px;
          display: inline-flex;
          align-items: center;
          gap: 9px;
          backdrop-filter: blur(12px);
          z-index: 4;
        }
        .sq-float-badge strong { font-size: 12.5px; color: #ffffff; display: block; }
        .sq-float-badge small { font-size: 10.5px; color: #94a3b8; display: block; }
        .sq-float-badge-1 {
          top: -12px;
          right: -10px;
          border-color: rgba(0, 210, 255, 0.45);
          animation: sqFloat1 4.5s ease-in-out infinite;
        }
        .sq-float-badge-2 {
          bottom: -12px;
          left: -10px;
          border-color: rgba(255, 102, 0, 0.45);
          animation: sqFloat2 5s ease-in-out infinite;
        }
        @keyframes sqFloat1 {
          0%, 100% { transform: translateY(0); }
          50% { transform: translateY(-7px); }
        }
        @keyframes sqFloat2 {
          0%, 100% { transform: translateY(0); }
          50% { transform: translateY(7px); }
        }

        /* Slide 2: Enterprise Cloud Nodes */
        .sq-cloud-nodes-grid {
          display: grid;
          grid-template-columns: 1fr 1fr;
          gap: 10px;
        }
        .sq-cloud-node {
          background: rgba(0, 14, 38, 0.7);
          border: 1px solid rgba(255, 255, 255, 0.08);
          border-radius: 12px;
          padding: 12px;
          display: flex;
          align-items: center;
          gap: 10px;
          transition: all 0.3s ease;
        }
        .sq-cloud-node:hover {
          border-color: rgba(0, 210, 255, 0.4);
          background: rgba(0, 24, 64, 0.85);
          transform: translateY(-2px);
        }
        .sq-node-icon-box {
          width: 34px;
          height: 34px;
          border-radius: 9px;
          display: flex;
          align-items: center;
          justify-content: center;
          flex-shrink: 0;
        }
        .sq-node-icon-box.orange { background: rgba(255, 102, 0, 0.15); color: #ff8533; border: 1px solid rgba(255, 102, 0, 0.3); }
        .sq-node-icon-box.blue { background: rgba(56, 189, 248, 0.15); color: #38bdf8; border: 1px solid rgba(56, 189, 248, 0.3); }
        .sq-node-icon-box.green { background: rgba(34, 197, 94, 0.15); color: #4ade80; border: 1px solid rgba(34, 197, 94, 0.3); }
        .sq-node-icon-box.purple { background: rgba(192, 132, 252, 0.15); color: #c084fc; border: 1px solid rgba(192, 132, 252, 0.3); }
        .sq-node-copy strong { font-size: 12.5px; color: #ffffff; display: block; font-weight: 700; }
        .sq-node-copy small { font-size: 10.5px; color: #94a3b8; display: block; }

        /* Slide 3: Growth Chart */
        .sq-chart-card {
          position: relative;
          width: 100%;
        }
        .sq-chart-svg {
          width: 100%;
          height: auto;
          display: block;
        }
        .sq-chart-grid-line {
          stroke: rgba(255, 255, 255, 0.08);
          stroke-dasharray: 4, 4;
        }
        .sq-chart-line {
          fill: none;
          stroke: #ff6600;
          stroke-width: 3.5;
          stroke-linecap: round;
          filter: drop-shadow(0 4px 10px rgba(255, 102, 0, 0.6));
        }
        .sq-chart-point {
          fill: #ffffff;
          stroke: #ff6600;
          stroke-width: 3;
        }
        /* Navigation & Tabs */
        .sq-hero-nav-arrow {
          position: absolute;
          top: 50%;
          transform: translateY(-50%);
          width: 44px;
          height: 44px;
          border-radius: 50%;
          background: rgba(255, 255, 255, 0.08);
          border: 1px solid rgba(255, 255, 255, 0.18);
          color: #ffffff;
          cursor: pointer;
          display: flex;
          align-items: center;
          justify-content: center;
          transition: all 0.25s ease;
          z-index: 10;
          backdrop-filter: blur(8px);
          padding: 0;
        }
        .sq-hero-nav-arrow:hover {
          background: #ff6600;
          border-color: #ff6600;
          transform: translateY(-50%) scale(1.08);
          box-shadow: 0 6px 18px rgba(255, 102, 0, 0.4);
        }
        .sq-hero-prev { left: 20px; }
        .sq-hero-next { right: 20px; }
        .sq-hero-tabs {
          position: absolute;
          bottom: 18px;
          left: 50%;
          transform: translateX(-50%);
          display: flex;
          gap: 8px;
          background: rgba(0, 16, 43, 0.7);
          border: 1px solid rgba(255, 255, 255, 0.12);
          border-radius: 30px;
          padding: 4px;
          backdrop-filter: blur(12px);
          z-index: 10;
        }
        .sq-hero-tab-btn {
          background: transparent;
          border: none;
          color: #94a3b8;
          font-size: 12.5px;
          font-weight: 600;
          padding: 7px 16px;
          border-radius: 24px;
          cursor: pointer;
          transition: all 0.25s ease;
          display: inline-flex;
          align-items: center;
          gap: 6px;
          font-family: inherit;
        }
        .sq-hero-tab-btn.active {
          background: #ff6600;
          color: #ffffff;
          font-weight: 700;
          box-shadow: 0 4px 14px rgba(255, 102, 0, 0.4);
        }
        .sq-hero-tab-num {
          font-size: 11px;
          opacity: 0.75;
        }
        /* Progress Bar */
        .sq-hero-progress-track {
          position: absolute;
          bottom: 0;
          left: 0;
          width: 100%;
          height: 3px;
          background: rgba(255, 255, 255, 0.08);
          z-index: 20;
        }
        .sq-hero-progress-bar {
          height: 100%;
          width: 0%;
          background: linear-gradient(90deg, #ff6600, #ff944d);
          transition: width 0.1s linear;
        }
        /* Mobile & Tablet Responsiveness */
        .sq-tab-txt-mobile { display: none; }
        @media (max-width: 991px) {
          .sq-hero-slider { min-height: auto; }
          .sq-hero-slide { padding: 36px 16px 85px; }
          .sq-hero-container {
            grid-template-columns: 1fr;
            gap: 22px;
            text-align: center;
          }
          .sq-hero-title { font-size: 30px; }
          .sq-hero-desc { margin: 0 auto 16px; }
          .sq-hero-actions { justify-content: center; }
          .sq-hero-pills { justify-content: center; }
          .sq-hero-nav-arrow { display: none; }
          .sq-float-badge-2 { display: none !important; }
          .sq-float-badge-1 {
            top: -12px;
            right: 10px;
            transform: scale(0.9);
            transform-origin: top right;
          }
        }
        @media (max-width: 640px) {
          .sq-hero-slide { padding: 24px 12px 88px; }
          .sq-hero-title { font-size: 23px; line-height: 1.25; margin-bottom: 10px; }
          .sq-hero-desc { font-size: 13px; line-height: 1.45; margin-bottom: 12px; }
          .sq-hero-actions { gap: 8px; margin-bottom: 12px; }
          .sq-hero-btn-primary,
          .sq-hero-btn-outline { font-size: 12.5px; padding: 9px 18px; }
          .sq-hero-pills { gap: 5px; margin-bottom: 14px; }
          .sq-hero-pill { font-size: 10px; padding: 4px 8px; }
          
          /* Code board adjustments for mobile */
          .sq-tech-board {
            padding: 12px 10px;
            border-radius: 14px;
          }
          .sq-board-header {
            margin-bottom: 8px;
            padding-bottom: 6px;
          }
          .sq-code-terminal {
            font-size: 10.5px;
            line-height: 1.5;
            padding: 9px 11px;
            min-height: 128px;
            margin-bottom: 8px;
          }
          .sq-telemetry-grid {
            gap: 5px;
          }
          .sq-telemetry-item {
            padding: 5px 2px;
            border-radius: 8px;
          }
          .sq-telemetry-val {
            font-size: 12px;
          }
          .sq-telemetry-label {
            font-size: 8px;
            margin-top: 1px;
          }
          .sq-float-badge-1 {
            top: -10px;
            right: 6px;
            transform: scale(0.82);
            transform-origin: top right;
            padding: 4px 8px;
          }

          /* Bottom tabs for mobile */
          .sq-tab-txt-full { display: none; }
          .sq-tab-txt-mobile { display: inline; }
          .sq-hero-tabs {
            bottom: 10px;
            gap: 4px;
            padding: 3px;
            background: rgba(0, 16, 43, 0.94);
            border: 1px solid rgba(255, 255, 255, 0.16);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.6);
            max-width: calc(100% - 20px);
          }
          .sq-hero-tab-btn {
            font-size: 11px;
            padding: 5px 14px;
            white-space: nowrap;
            gap: 4px;
          }
        }

        .hm-cert-slider {
          position: relative;
          width: 100%;
          max-width: 1200px;
          margin: 0 auto;
          padding: 0 50px;
          box-sizing: border-box;
        }
        .hm-cert-viewport {
          position: relative;
          width: 100%;
          overflow: hidden !important;
          border-radius: 16px;
        }
        .hm-cert-track {
          display: flex !important;
          flex-direction: row !important;
          flex-wrap: nowrap !important;
          gap: 24px !important;
          padding: 0 !important;
          margin: 0 !important;
          will-change: transform;
          box-sizing: border-box;
        }
        .hm-cert-card {
          flex: 0 0 calc((100% - 48px) / 3) !important;
          width: calc((100% - 48px) / 3) !important;
          max-width: calc((100% - 48px) / 3) !important;
          min-width: calc((100% - 48px) / 3) !important;
          box-sizing: border-box !important;
          background: #ffffff;
          border-radius: 16px;
          overflow: hidden;
          box-shadow: 0 8px 24px rgba(0, 0, 0, 0.18);
          transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hm-cert-card:hover {
          transform: translateY(-4px);
          box-shadow: 0 14px 30px rgba(0, 0, 0, 0.28);
        }
        .hm-cert-card img {
          display: block !important;
          width: 100% !important;
          height: auto !important;
          aspect-ratio: 1 / 1;
          object-fit: cover !important;
          border-radius: 16px;
        }
        .hm-cert-nav {
          position: absolute;
          top: 50%;
          transform: translateY(-50%);
          width: 42px;
          height: 42px;
          border-radius: 50%;
          background: #00173e;
          border: 1.5px solid rgba(255, 255, 255, 0.25);
          color: #ffffff !important;
          cursor: pointer;
          z-index: 10;
          display: flex;
          align-items: center;
          justify-content: center;
          transition: all 0.25s ease;
          box-shadow: 0 4px 14px rgba(0, 0, 0, 0.3);
          padding: 0;
        }
        .hm-cert-nav:hover {
          background: #ff6600;
          border-color: #ff6600;
          transform: translateY(-50%) scale(1.08);
          box-shadow: 0 6px 18px rgba(255, 102, 0, 0.35);
        }
        .hm-cert-prev { left: 0; }
        .hm-cert-next { right: 0; }
        .hm-cert-dots {
          display: flex;
          justify-content: center;
          align-items: center;
          gap: 8px;
          margin-top: 26px;
        }
        .hm-cert-dot {
          appearance: none;
          width: 10px;
          height: 10px;
          padding: 0;
          border: 0;
          border-radius: 999px;
          background: rgba(255, 255, 255, 0.35);
          cursor: pointer;
          transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .hm-cert-dot.active {
          width: 28px;
          background: #ff6600;
        }
        @media (max-width: 1023px) and (min-width: 640px) {
          .hm-cert-track { gap: 20px !important; }
          .hm-cert-card {
            flex: 0 0 calc((100% - 20px) / 2) !important;
            width: calc((100% - 20px) / 2) !important;
            max-width: calc((100% - 20px) / 2) !important;
            min-width: calc((100% - 20px) / 2) !important;
          }
        }
        @media (max-width: 639px) {
          .hm-cert-slider { padding: 0 38px; }
          .hm-cert-track { gap: 16px !important; }
          .hm-cert-card {
            flex: 0 0 100% !important;
            width: 100% !important;
            max-width: 100% !important;
            min-width: 100% !important;
          }
          .hm-cert-nav { width: 32px; height: 32px; }
          .hm-cert-nav svg { width: 16px; height: 16px; }
        }
        .hm-video-card {
          position: relative;
          background: #000;
          border-radius: 10px;
          overflow: hidden;
          aspect-ratio: 1 / 1;
          box-shadow: 0 8px 24px rgba(0, 0, 0, 0.18);
          transition: transform 0.28s ease, box-shadow 0.28s ease;
        }
        .hm-video-card:hover {
          transform: translateY(-3px);
          box-shadow: 0 14px 32px rgba(0, 0, 0, 0.28);
        }
        .hm-video-thumb {
          position: relative;
          width: 100%;
          height: 100%;
          background: #000;
          overflow: hidden;
          pointer-events: auto !important;
        }
        .hm-video-facade {
          position: absolute;
          inset: 0;
          width: 100%;
          height: 100%;
          padding: 0;
          margin: 0;
          border: 0;
          background: #000;
          cursor: pointer;
          display: block;
          text-align: left;
          z-index: 5;
          outline: none;
        }
        .hm-video-poster {
          width: 100%;
          height: 100%;
          object-fit: cover;
          display: block;
          transition: transform 0.4s ease, filter 0.3s ease;
        }
        .hm-video-card:hover .hm-video-poster,
        .hm-video-facade:focus-visible .hm-video-poster {
          transform: scale(1.05);
          filter: brightness(0.92);
        }
        .hm-video-overlay {
          position: absolute;
          inset: 0;
          background: linear-gradient(180deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.06) 40%, rgba(0,0,0,0.18) 65%, rgba(0,0,0,0.72) 100%);
          display: flex;
          flex-direction: column;
          justify-content: space-between;
          padding: 14px;
          box-sizing: border-box;
          transition: background 0.3s ease;
        }
        .hm-video-card:hover .hm-video-overlay {
          background: linear-gradient(180deg, rgba(0,0,0,0.78) 0%, rgba(0,0,0,0.02) 40%, rgba(0,0,0,0.1) 65%, rgba(0,0,0,0.82) 100%);
        }
        .hm-video-card-title {
          font-size: 13px;
          font-weight: 700;
          color: #ffffff;
          line-height: 1.35;
          margin: 0;
          display: -webkit-box;
          -webkit-line-clamp: 2;
          -webkit-box-orient: vertical;
          overflow: hidden;
          text-shadow: 0 2px 4px rgba(0,0,0,0.85);
          font-family: inherit;
        }
        .hm-video-play-wrap {
          align-self: center;
          display: flex;
          align-items: center;
          justify-content: center;
          transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
          filter: drop-shadow(0 6px 14px rgba(0,0,0,0.5));
        }
        .hm-video-play-svg {
          width: 58px;
          height: 40px;
          display: block;
        }
        .hm-video-play-svg .play-bg {
          fill: #ff0000;
          transition: fill 0.2s ease, opacity 0.2s ease;
          opacity: 0.92;
        }
        .hm-video-card:hover .hm-video-play-wrap,
        .hm-video-facade:focus-visible .hm-video-play-wrap {
          transform: scale(1.15);
        }
        .hm-video-card:hover .hm-video-play-svg .play-bg {
          opacity: 1;
        }
        .hm-video-bottom {
          display: flex;
          align-items: center;
          justify-content: space-between;
        }
        .hm-video-badge {
          display: inline-flex;
          align-items: center;
          gap: 5px;
          padding: 3px 9px;
          border-radius: 999px;
          background: rgba(0, 0, 0, 0.62);
          backdrop-filter: blur(4px);
          color: #fff;
          font-size: 11px;
          font-weight: 600;
          text-transform: uppercase;
          letter-spacing: 0.5px;
        }
        /* ---- Video Lightbox Modal ---- */
        .sq-video-modal {
          position: fixed;
          inset: 0;
          z-index: 999999;
          display: flex;
          align-items: center;
          justify-content: center;
          padding: 24px;
          opacity: 0;
          visibility: hidden;
          pointer-events: none;
          transition: opacity 0.3s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .sq-video-modal.is-active {
          opacity: 1;
          visibility: visible;
          pointer-events: auto;
        }
        .sq-video-modal-backdrop {
          position: absolute;
          inset: 0;
          background: rgba(0, 8, 24, 0.88);
          backdrop-filter: blur(8px);
          -webkit-backdrop-filter: blur(8px);
        }
        .sq-video-modal-dialog {
          position: relative;
          width: 100%;
          max-width: 980px;
          background: #000;
          border-radius: 16px;
          overflow: hidden;
          box-shadow: 0 25px 60px -10px rgba(0, 0, 0, 0.8), 0 0 0 1px rgba(255, 255, 255, 0.12);
          transform: scale(0.92) translateY(12px);
          transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
          z-index: 10;
        }
        .sq-video-modal.is-active .sq-video-modal-dialog {
          transform: scale(1) translateY(0);
        }
        .sq-video-modal-header {
          display: flex;
          align-items: center;
          justify-content: space-between;
          padding: 12px 18px;
          background: #071530;
          border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }
        .sq-video-modal-title {
          font-size: 15px;
          font-weight: 600;
          color: #ffffff;
          margin: 0;
          white-space: nowrap;
          overflow: hidden;
          text-overflow: ellipsis;
          padding-right: 14px;
          font-family: inherit;
        }
        .sq-video-modal-close {
          display: inline-flex;
          align-items: center;
          justify-content: center;
          width: 36px;
          height: 36px;
          border-radius: 50%;
          background: rgba(255, 255, 255, 0.1);
          border: 0;
          color: #ffffff;
          cursor: pointer;
          flex-shrink: 0;
          transition: background 0.2s ease, transform 0.2s ease, color 0.2s ease;
        }
        .sq-video-modal-close:hover {
          background: #ff5a00;
          color: #fff;
          transform: scale(1.08);
        }
        .sq-video-responsive {
          position: relative;
          width: 100%;
          aspect-ratio: 16 / 9;
          background: #000;
        }
        .sq-video-responsive iframe,
        .sq-video-responsive video {
          position: absolute;
          inset: 0;
          width: 100%;
          height: 100%;
          border: 0;
          display: block;
        }
        @media (max-width: 767px) {
          .sq-video-modal {
            padding: 12px;
          }
          .sq-video-modal-dialog {
            border-radius: 12px;
          }
          .sq-video-modal-header {
            padding: 10px 14px;
          }
          .sq-video-modal-title {
            font-size: 13px;
          }
          .sq-video-modal-close {
            width: 32px;
            height: 32px;
          }
        }
        .hm-clients-section .hm-section-head {
          position: relative;
          z-index: 5;
        }
        .hm-clients-section .hm-clients-title {
          position: relative;
          z-index: 6;
          color: #101a1f !important;
          background: transparent !important;
          background-image: none !important;
          -webkit-background-clip: initial !important;
          background-clip: initial !important;
          -webkit-text-fill-color: #101a1f !important;
          font-weight: 700 !important;
          opacity: 1 !important;
          filter: none !important;
          mix-blend-mode: normal !important;
          -webkit-mask-image: none !important;
          mask-image: none !important;
        }
        .hm-clients-section .hm-clients-title .hm-orange {
          color: #ff5a00 !important;
          background: transparent !important;
          background-image: none !important;
          -webkit-text-fill-color: #ff5a00 !important;
          opacity: 1 !important;
          filter: none !important;
          mix-blend-mode: normal !important;
          -webkit-mask-image: none !important;
          mask-image: none !important;
        }
        .hm-testimonials-section .hm-ts-card {
          position: relative;
          overflow: visible !important;
          padding: 24px 24px 48px !important;
          border: 0 !important;
          border-radius: 0 !important;
          background: #fff !important;
          box-shadow: none !important;
          flex: 0 0 100% !important;
          width: 100% !important;
          min-width: 100% !important;
          height: auto !important;
          box-sizing: border-box !important;
          transform: none !important;
        }
        .hm-testimonials-section .hm-ts-card.active {
          transform: none !important;
        }
        .hm-testimonials-section .hm-ts-stars {
          display: none !important;
        }
        .hm-testimonials-section .hm-ts-quote {
          max-width: 1120px !important;
          margin: 0 auto !important;
          color: #171717 !important;
          font-size: clamp(16px, 1.35vw, 20px) !important;
          font-style: normal !important;
          font-weight: 400 !important;
          line-height: 1.65 !important;
          text-align: center !important;
          opacity: 1 !important;
          display: block !important;
          min-height: 0 !important;
        }
        .hm-testimonials-section .hm-ts-card::before {
          content: "";
          position: absolute;
          bottom: 22px;
          left: 50%;
          width: 266px;
          height: 1px;
          background: #c5c5c5;
          transform: translateX(-50%);
        }
        .hm-testimonials-section .hm-ts-card::after {
          content: "";
          position: absolute;
          bottom: 14px;
          left: 50%;
          width: 16px;
          height: 16px;
          border-bottom: 1px solid #c5c5c5;
          border-left: 1px solid #c5c5c5;
          background: #fff;
          transform: translateX(-50%) rotate(-45deg);
        }
        .hm-testimonials-section {
          min-height: 0 !important;
          padding: 54px 0 58px !important;
          background: #fff !important;
        }
        .hm-testimonials-section .hm-ts-inner {
          width: 100%;
          max-width: 1500px;
          margin: 0 auto;
          padding: 0 24px;
        }
        .hm-testimonials-section .hm-section-head {
          margin: 0 0 12px !important;
          text-align: center !important;
        }
        .hm-testimonials-section .hm-section-head h2 {
          margin: 0 !important;
          color: #001b48 !important;
          font-size: clamp(27px, 2vw, 35px) !important;
          font-weight: 600 !important;
          line-height: 1.25 !important;
          text-align: center !important;
        }
        .hm-testimonials-section .hm-section-head .hm-line {
          width: 40px !important;
          height: 3px !important;
          margin: 28px auto 20px !important;
          background: #ff5a00 !important;
        }
        .hm-testimonials-section .hm-ts-slider {
          width: 100%;
          overflow: hidden;
          position: relative;
          transition: height 0.4s ease;
        }
        .hm-testimonials-section .hm-ts-track {
          display: flex;
          align-items: flex-start !important;
          will-change: transform;
        }
        .hm-testimonials-section .hm-ts-dots-container {
          margin-top: 20px !important;
        }
        .hm-testimonials-section .hm-ts-dots {
          display: flex !important;
          align-items: center;
          justify-content: center;
          gap: clamp(35px, 6vw, 95px) !important;
        }
        .hm-testimonials-section .hm-ts-thumb {
          align-items: center !important;
          gap: 14px !important;
          padding: 0 !important;
          border: 0 !important;
          background: transparent !important;
          color: #ff5a00 !important;
          font-size: 18px !important;
          font-weight: 600 !important;
          white-space: nowrap;
          cursor: pointer;
        }
        .hm-testimonials-section .hm-ts-thumb img {
          width: 54px !important;
          height: 54px !important;
          border: 2px solid transparent;
          border-radius: 50% !important;
          object-fit: cover;
        }
        .hm-testimonials-section .hm-ts-thumb.active img {
          border-color: #ff5a00 !important;
        }
        @media (max-width: 767px) {
          .hm-testimonials-section { min-height: 0 !important; padding: 36px 0 !important; }
          .hm-testimonials-section .hm-ts-inner { padding: 0 16px; }
          .hm-testimonials-section .hm-ts-track { align-items: flex-start !important; }
          .hm-testimonials-section .hm-ts-card { padding: 14px 8px 44px !important; height: auto !important; }
          .hm-testimonials-section .hm-ts-quote { min-height: 0 !important; font-size: 16px !important; line-height: 1.6 !important; }
          .hm-testimonials-section .hm-ts-dots { gap: 16px !important; }
          .hm-testimonials-section .hm-ts-thumb span { display: none; }
        }
      </style>
@endpush

@section('content')
<main class="sortiq-home font-raleway"><div class="font-raleway">
<h1 class="sr-only">Sortiq Solutions | Leading Web Development, Mobile Apps &amp; Digital Marketing Company</h1>

<!-- ===================== ULTRA-FAST HERO SLIDER ===================== -->
<section class="sq-hero-slider" id="sqHeroSlider" aria-roledescription="carousel" aria-label="Sortiq Solutions Highlights">
  <div class="sq-hero-glow-1" aria-hidden="true"></div>
  <div class="sq-hero-glow-2" aria-hidden="true"></div>

  <!-- SLIDES TRACK -->
  <div class="sq-hero-track" id="sqHeroTrack">

    <!-- SLIDE 1: Web & Mobile Apps -->
    <article class="sq-hero-slide" aria-roledescription="slide" aria-label="1 of 3: Web and Mobile App Engineering">
      <div class="sq-hero-container">
        <div class="sq-hero-content">
          <div class="sq-hero-badge">
            <span class="sq-hero-badge-pulse" aria-hidden="true"></span>
            <span>Full-Cycle Software Engineering</span>
          </div>
          <h2 class="sq-hero-title">
            Architecting High-Speed <span>Web &amp; Mobile</span> Apps
          </h2>
          <p class="sq-hero-desc">
            We design, develop, and scale responsive web applications, modern SaaS platforms, and mobile apps engineered for blazing performance, bulletproof security, and higher conversions.
          </p>
          <div class="sq-hero-actions">
            <a href="{{ route('frontend.services.web') }}" class="sq-hero-btn-primary">
              <span>Explore Services</span>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </a>
            <a href="{{ route('frontend.portfolio') }}" class="sq-hero-btn-outline">
              <span>View Portfolio</span>
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
            </a>
          </div>
          <div class="sq-hero-pills">
            <span class="sq-hero-pill">⚡ 99.9% Uptime Architecture</span>
            <span class="sq-hero-pill">🚀 3.5x Faster Load Time</span>
            <span class="sq-hero-pill">🔒 Enterprise-Grade Security</span>
          </div>
        </div>

        <!-- SLIDE 1 VISUAL: REACT CODE ENGINE -->
        <div class="sq-hero-visual">
          <div class="sq-tech-stage">
            <div class="sq-float-badge sq-float-badge-1">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
              <div>
                <strong>React 19 + Next.js 15</strong>
                <small>High Concurrency Frontend</small>
              </div>
            </div>

            <div class="sq-tech-board">
              <div class="sq-board-header">
                <div class="sq-board-dots">
                  <span class="sq-board-dot d-red"></span>
                  <span class="sq-board-dot d-yellow"></span>
                  <span class="sq-board-dot d-green"></span>
                </div>
                <div class="sq-board-title-tag">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg>
                  <span>SortiqApp.tsx</span>
                </div>
                <span class="sq-live-badge"><span class="sq-live-dot"></span> Active</span>
              </div>

              <div class="sq-code-terminal" id="sqCodeTerminal1"></div>

              <div class="sq-telemetry-grid">
                <div class="sq-telemetry-item">
                  <span class="sq-telemetry-val c-green">0.18s</span>
                  <span class="sq-telemetry-label">Page Speed</span>
                </div>
                <div class="sq-telemetry-item">
                  <span class="sq-telemetry-val c-orange">100/100</span>
                  <span class="sq-telemetry-label">Core Web Vitals</span>
                </div>
                <div class="sq-telemetry-item">
                  <span class="sq-telemetry-val c-blue">150+</span>
                  <span class="sq-telemetry-label">Apps Built</span>
                </div>
              </div>
            </div>

            <div class="sq-float-badge sq-float-badge-2">
              <span class="sq-live-dot" style="background: #ff8533; box-shadow: 0 0 8px #ff8533;"></span>
              <div>
                <strong>Global Edge Delivery</strong>
                <small>&lt; 15ms Latency Worldwide</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </article>

    <!-- SLIDE 2: Enterprise IT & Wix Partner -->
    <article class="sq-hero-slide" aria-roledescription="slide" aria-label="2 of 3: Enterprise IT and Certified Wix Partner">
      <div class="sq-hero-container">
        <div class="sq-hero-content">
          <div class="sq-hero-badge">
            <span class="sq-hero-badge-pulse" aria-hidden="true"></span>
            <span>Certified Wix Partner &amp; Cloud IT</span>
          </div>
          <h2 class="sq-hero-title">
            Scaling Brands With <span>Future-Ready IT</span> Solutions
          </h2>
          <p class="sq-hero-desc">
            As a certified Wix Studio Partner and ISO 9001:2015 accredited company, we build bespoke enterprise web platforms, custom cloud architectures, and seamless digital transformations.
          </p>
          <div class="sq-hero-actions">
            <a href="{{ route('frontend.contact') }}" class="sq-hero-btn-primary">
              <span>Start Your Project</span>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </a>
            <a href="{{ route('frontend.why-us') }}" class="sq-hero-btn-outline">
              <span>Why Choose Us</span>
            </a>
          </div>
          <div class="sq-hero-pills">
            <span class="sq-hero-pill">🏆 Certified Wix Partner</span>
            <span class="sq-hero-pill">⚙️ Custom API &amp; ERP Cloud</span>
            <span class="sq-hero-pill">🎖️ ISO 9001:2015 Accredited</span>
          </div>
        </div>

        <!-- SLIDE 2 VISUAL: PHP / LARAVEL CORE ENGINE -->
        <div class="sq-hero-visual">
          <div class="sq-tech-stage">
            <div class="sq-float-badge sq-float-badge-1">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
              <div>
                <strong>PHP 8.3 + Laravel 11</strong>
                <small>Enterprise Cloud Backend</small>
              </div>
            </div>

            <div class="sq-tech-board">
              <div class="sq-board-header">
                <div class="sq-board-dots">
                  <span class="sq-board-dot d-red"></span>
                  <span class="sq-board-dot d-yellow"></span>
                  <span class="sq-board-dot d-green"></span>
                </div>
                <div class="sq-board-title-tag">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#a855f7" stroke-width="2"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg>
                  <span>SortiqEnterprise.php</span>
                </div>
                <span class="sq-live-badge"><span class="sq-live-dot"></span> Synced</span>
              </div>

              <div class="sq-code-terminal" id="sqCodeTerminal2"></div>

              <div class="sq-telemetry-grid">
                <div class="sq-telemetry-item">
                  <span class="sq-telemetry-val c-green">0 Downtime</span>
                  <span class="sq-telemetry-label">Deployment</span>
                </div>
                <div class="sq-telemetry-item">
                  <span class="sq-telemetry-val c-orange">25k+</span>
                  <span class="sq-telemetry-label">Req / Sec</span>
                </div>
                <div class="sq-telemetry-item">
                  <span class="sq-telemetry-val c-blue">99.99%</span>
                  <span class="sq-telemetry-label">Cloud SLA</span>
                </div>
              </div>
            </div>

            <div class="sq-float-badge sq-float-badge-2">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ff8533" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><path d="m4.93 4.93 4.24 4.24"></path><path d="m14.83 9.17 4.24-4.24"></path><path d="m14.83 14.83 4.24 4.24"></path><path d="m9.17 14.83-4.24 4.24"></path></svg>
              <div>
                <strong>ISO 9001:2015 Accredited</strong>
                <small>Official Wix Studio Partner</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </article>

    <!-- SLIDE 3: Data-Driven Marketing & SEO -->
    <article class="sq-hero-slide" aria-roledescription="slide" aria-label="3 of 3: Data-Driven Marketing and SEO">
      <div class="sq-hero-container">
        <div class="sq-hero-content">
          <div class="sq-hero-badge">
            <span class="sq-hero-badge-pulse" aria-hidden="true"></span>
            <span>Data-Driven Growth &amp; Performance</span>
          </div>
          <h2 class="sq-hero-title">
            Grow Revenue With <span>Targeted SEO &amp; Marketing</span>
          </h2>
          <p class="sq-hero-desc">
            Transform visitors into high-value clients. Our battle-tested SEO, performance advertising, and conversion rate optimization campaigns produce real, compounding ROI.
          </p>
          <div class="sq-hero-actions">
            <a href="{{ route('frontend.services.seo') }}" class="sq-hero-btn-primary">
              <span>Get Free SEO Audit</span>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </a>
            <a href="{{ route('frontend.services.marketing') }}" class="sq-hero-btn-outline">
              <span>Digital Marketing</span>
            </a>
          </div>
          <div class="sq-hero-pills">
            <span class="sq-hero-pill">📈 +340% Avg Traffic Growth</span>
            <span class="sq-hero-pill">🎯 High-Intent Lead Gen</span>
            <span class="sq-hero-pill">📊 Real-Time Analytics</span>
          </div>
        </div>

        <!-- SLIDE 3 VISUAL: JAVASCRIPT REAL-TIME GROWTH ENGINE -->
        <div class="sq-hero-visual">
          <div class="sq-tech-stage">
            <div class="sq-float-badge sq-float-badge-1">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ff8533" stroke-width="2.5"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
              <div>
                <strong>Vanilla JS + Google V8</strong>
                <small>High-Throughput Analytics</small>
              </div>
            </div>

            <div class="sq-tech-board">
              <div class="sq-board-header">
                <div class="sq-board-dots">
                  <span class="sq-board-dot d-red"></span>
                  <span class="sq-board-dot d-yellow"></span>
                  <span class="sq-board-dot d-green"></span>
                </div>
                <div class="sq-board-title-tag">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#facc15" stroke-width="2"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg>
                  <span>growthEngine.js</span>
                </div>
                <span class="sq-live-badge"><span class="sq-live-dot"></span> Optimized</span>
              </div>

              <div class="sq-code-terminal" id="sqCodeTerminal3"></div>

              <div class="sq-telemetry-grid">
                <div class="sq-telemetry-item">
                  <span class="sq-telemetry-val c-orange">4.8x</span>
                  <span class="sq-telemetry-label">Avg ROAS</span>
                </div>
                <div class="sq-telemetry-item">
                  <span class="sq-telemetry-val c-green">Top 3</span>
                  <span class="sq-telemetry-label">Google Rank</span>
                </div>
                <div class="sq-telemetry-item">
                  <span class="sq-telemetry-val c-blue">+340%</span>
                  <span class="sq-telemetry-label">Traffic Spike</span>
                </div>
              </div>
            </div>

            <div class="sq-float-badge sq-float-badge-2">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2.5"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
              <div>
                <strong>Google Partner Certified</strong>
                <small>High-Intent Buyer Traffic</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </article>

  </div>

  <!-- PREV / NEXT BUTTONS -->
  <button type="button" class="sq-hero-nav-arrow sq-hero-prev" id="sqHeroPrev" aria-label="Previous slide">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="15 18 9 12 15 6"></polyline></svg>
  </button>
  <button type="button" class="sq-hero-nav-arrow sq-hero-next" id="sqHeroNext" aria-label="Next slide">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="9 18 15 12 9 6"></polyline></svg>
  </button>

  <!-- BOTTOM TABS -->
  <div class="sq-hero-tabs" role="tablist" aria-label="Hero slider tabs">
    <button type="button" class="sq-hero-tab-btn active" data-slide-index="0" role="tab" aria-selected="true">
      <span class="sq-hero-tab-num">01</span> <span class="sq-tab-txt-full">Web &amp; Apps</span><span class="sq-tab-txt-mobile">Web</span>
    </button>
    <button type="button" class="sq-hero-tab-btn" data-slide-index="1" role="tab" aria-selected="false">
      <span class="sq-hero-tab-num">02</span> <span class="sq-tab-txt-full">Enterprise IT</span><span class="sq-tab-txt-mobile">Cloud</span>
    </button>
    <button type="button" class="sq-hero-tab-btn" data-slide-index="2" role="tab" aria-selected="false">
      <span class="sq-hero-tab-num">03</span> <span class="sq-tab-txt-full">SEO &amp; Growth</span><span class="sq-tab-txt-mobile">SEO</span>
    </button>
  </div>

  <!-- PROGRESS BAR -->
  <div class="sq-hero-progress-track" aria-hidden="true">
    <div class="sq-hero-progress-bar" id="sqHeroProgressBar"></div>
  </div>
</section>

<section class="hm-why-section">
  <div class="max-w-[1200px] mx-auto px-4 w-full hm-why-container">
    <div class="hm-why-head">
      <h2>Why Choose Us</h2>
      <div class="hm-why-accent-bar" aria-hidden="true"></div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-16 lg:gap-10 justify-items-center w-full">
      <div class="w-full">
        <div class="hm-why-card">
          <div class="hm-why-icon"><img src="{{ asset('frontend-assets/media/home/why-us/tech-expertise-image.webp') }}" alt="Tech Expertise" loading="lazy" decoding="async"></div>
          <h3>Strategy-First Approach</h3>
          <p>We start with understanding your business goals and target audience. Every website and marketing campaign is built with a clear strategy to drive growth and leads.</p>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-why-card">
          <div class="hm-why-icon"><img src="{{ asset('frontend-assets/media/home/why-us/custom-solutions-image.webp') }}" alt="Custom Solutions" loading="lazy" decoding="async"></div>
          <h3>Conversion-Driven Development</h3>
          <p>Our websites are designed to do more than just look good. We create user-focused, SEO-friendly content that turns visitors into paying clients.</p>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-why-card">
          <div class="hm-why-icon"><img src="{{ asset('frontend-assets/media/home/why-us/quality-and-timeless-image.webp') }}" alt="Quality &amp; Timeliness" loading="lazy" decoding="async"></div>
          <h3>Data-Driven Marketing</h3>
          <p>To optimize campaigns, we rely on tracking, analytics, and actual performance data. Every decision is driven by insights to maximize ROI and reduce wasted ad spend.</p>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-why-card">
          <div class="hm-why-icon"><img src="{{ asset('frontend-assets/media/home/why-us/online-support-icon.webp') }}" alt="On-Going Support" loading="lazy" decoding="async"></div>
          <h3>Long-Term Growth Partner</h3>
          <p>We don’t disappear after launch. From ongoing optimization and support to scaling your digital presence, we work as a long-term partner in your business growth.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===================== WIX PARTNER + CERTIFICATIONS (navy, same copy as live site) ===================== -->
<section class="hm-wix-section">

  <div class="max-w-[1200px] mx-auto px-4 w-full hm-wix-why-row">

    <div class="hm-section-head text-center lg:px-12">
      <h2 style="color: #fff;">Proud to be a Wix Partner</h2>
      <div class="hm-line mx-auto"></div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-10 items-center w-full">

      <div class="w-full">
        <p class="hm-wix-text">
          At Sortiq Solutions Pvt. Ltd., we are honored to be recognized as a certified Wix Partner. This partnership empowers us to build high-performing, visually appealing, and fully responsive websites tailored to your business goals. With Wix’s powerful tools and our technical expertise, we bring your ideas to life—seamlessly, efficiently, and with stunning design precision.
        </p>

        <p class="hm-wix-text mb-0">
          Whether you’re a startup, SME, or an established brand, we’re here to create a digital presence that stands out. We simplify the digital journey so you can focus on growing your business. Let’s build something amazing together with Wix.
        </p>
      </div>

      <div class="w-full text-center">
        <div class="hm-wix-badge-wrap">
          <a href="https://www.wix.com/studio/community/partners/sortiq-solutions-pvt-ltd"
             target="_blank"
             rel="noopener noreferrer"
             aria-label="View Sortiq Solutions on Wix Studio">
            <img src="{{ asset('frontend-assets/media/home/badges/EN_legend_small.webp') }}"
                 alt="Wix Partner"
                 class="hm-wix-img"
                 loading="lazy"
                 decoding="async">
          </a>
        </div>
      </div>

    </div>

  </div>

  <!-- CERTIFICATION SECTION -->
  <div class="hm-certs-inner">

    <div class="hm-section-head text-center hm-certs-head">
      <h2 style="color: #fff;">Global Certifications &amp; Recognitions</h2>
      <div class="hm-line mx-auto"></div>
    </div>

    <div class="hm-cert-slider">
      <button type="button" class="hm-cert-nav hm-cert-prev" aria-label="Previous certificate">
        <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2.5" fill="none" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
      </button>

      <!-- SLIDER -->
      <div class="hm-cert-viewport">
        <div class="hm-cert-track">
          <!-- CARD -->
          <div class="hm-cert-card">
            <img src="{{ asset('frontend-assets/media/home/badges/wix-web-designer-300x300.jpg') }}" alt="Wix Web Designer" loading="lazy" decoding="async">
          </div>

          <div class="hm-cert-card">
            <img src="{{ asset('frontend-assets/media/home/badges/Digital-Advertising-300x300.jpg') }}" alt="Digital Advertising" loading="lazy" decoding="async">
          </div>

          <div class="hm-cert-card">
            <img src="{{ asset('frontend-assets/media/home/badges/social-media-certified-300x300.jpg') }}" alt="Social Media Certified" loading="lazy" decoding="async">
          </div>

          <div class="hm-cert-card">
            <img src="{{ asset('frontend-assets/media/home/badges/wix-studio-300x300.jpg') }}" alt="Wix Studio" loading="lazy" decoding="async">
          </div>
        </div>
      </div>

      <button type="button" class="hm-cert-nav hm-cert-next" aria-label="Next certificate">
        <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2.5" fill="none" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
      </button>

      <div class="hm-cert-dots" aria-label="Certificate slides"></div>
    </div>

  </div>

</section>

<!-- ===================== HOW WE MAKE IT HAPPEN (VIDEOS) ===================== -->
<section class="hm-videos-section">
  <div class="hm-videos-wrap">
    <div class="hm-section-head text-center hm-videos-head">
      <span class="hm-workflow-badge">Work Flow</span>
      <h2>How We Make It Happen</h2>
    </div>
    <div class="hm-video-grid">
      @foreach($homeVideos as $video)
        @php
          $videoTitle = $video->title ?: 'Sortiq Solutions Video';
          $thumbUrl = $video->thumbnail_url;
          $playbackUrl = $video->playback_url;
          $playbackType = $video->playback_type ?? 'youtube';
        @endphp
        <div class="hm-video-card">
          <div class="hm-video-thumb">
            <button type="button"
                    class="hm-video-facade"
                    data-video-open
                    data-playback-url="{{ $playbackUrl }}"
                    data-playback-type="{{ $playbackType }}"
                    data-video-title="{{ $videoTitle }}"
                    aria-label="Play video: {{ $videoTitle }}">
              <img
                src="{{ $thumbUrl }}"
                alt="{{ $videoTitle }}"
                class="hm-video-poster"
                loading="lazy"
                decoding="async"
              >
              <div class="hm-video-overlay">
                <div class="hm-video-top">
                  <h3 class="hm-video-card-title">{{ $videoTitle }}</h3>
                </div>
                <div class="hm-video-play-wrap" aria-hidden="true">
                  <svg class="hm-video-play-svg" viewBox="0 0 68 48">
                    <path class="play-bg" d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z"></path>
                    <path d="M 45,24 27,14 27,34" fill="#ffffff"></path>
                  </svg>
                </div>
                <div class="hm-video-bottom">
                  <span class="hm-video-badge">Watch Video</span>
                </div>
              </div>
            </button>
          </div>
        </div>
      @endforeach
    </div>
    <div class="hm-videos-footer">
      <a href="https://www.youtube.com/@SortiqSolutions" target="_blank" rel="noopener" class="hm-btn-orange" aria-label="View all Sortiq Solutions portfolio and workflow videos on YouTube">VIEW ALL VIDEOS</a>
    </div>
  </div>
</section>

<!-- VIDEO LIGHTBOX MODAL -->
<div id="sqVideoModal" class="sq-video-modal" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="sqVideoModalTitle">
  <div class="sq-video-modal-backdrop" data-close-video-modal></div>
  <div class="sq-video-modal-dialog">
    <div class="sq-video-modal-header">
      <div id="sqVideoModalTitle" class="sq-video-modal-title" role="heading" aria-level="3">Video Player</div>
      <button type="button" class="sq-video-modal-close" data-close-video-modal aria-label="Close video player">
        <svg viewBox="0 0 24 24" width="22" height="22" stroke="currentColor" stroke-width="2.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
      </button>
    </div>
    <div class="sq-video-modal-body">
      <div id="sqVideoContainer" class="sq-video-responsive"></div>
    </div>
  </div>
</div>

<!-- ===================== WHAT WE OFFER (SERVICES) ===================== -->
<section class="hm-services-section hm-reveal-up">
  <div class="max-w-[1200px] mx-auto px-4 w-full">
    <div class="hm-section-head text-center">
      <h2 style="color: #00173E;">What We Offer</h2>
      <div class="hm-line mx-auto"></div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-10 justify-items-center w-full">
      <div class="w-full">
        <div class="hm-service-card">
          <div class="hm-service-icon"><img src="{{ asset('frontend-assets/media/home/services/graphic-design-icon.png') }}" alt="Website Designing" loading="lazy" decoding="async"></div>
          <h3>Website Designing</h3>
          <p>We create visually stunning and user-friendly websites, tailored to meet your business needs and elevate your online presence.</p>
          <a href="{{ url('/website-design-services') }}" class="hm-service-arrow"><iconify-icon icon="fa6-solid:arrow-right" width="32"></iconify-icon></a>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-service-card">
          <div class="hm-service-icon"><img src="{{ asset('frontend-assets/media/home/services/website-development-icon.png') }}" alt="Website Development" loading="lazy" decoding="async"></div>
          <h3>Website Development</h3>
          <p>We provide customized, high-quality website development services to elevate your business online.</p>
          <a href="{{ url('/website-development-services') }}" class="hm-service-arrow"><iconify-icon icon="fa6-solid:arrow-right" width="32"></iconify-icon></a>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-service-card">
          <div class="hm-service-icon"><img src="{{ asset('frontend-assets/media/home/services/mobile-app-icon.png') }}" alt="Mobile App Dev" loading="lazy" decoding="async"></div>
          <h3>Mobile App Dev</h3>
          <p>Transforming ideas into reality with cutting-edge mobile app development solutions tailored to your business needs.</p>
          <a href="{{ url('/app-development-company') }}" class="hm-service-arrow"><iconify-icon icon="fa6-solid:arrow-right" width="32"></iconify-icon></a>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-service-card">
          <div class="hm-service-icon"><img src="{{ asset('frontend-assets/media/home/services/graphic-design-icon.png') }}" alt="Graphic Design" loading="lazy" decoding="async"></div>
          <h3>Graphic Design</h3>
          <p>Crafting visually stunning and impactful graphic designs to elevate your brand and captivate your audience.</p>
          <a href="{{ url('/graphic-design-services') }}" class="hm-service-arrow"><iconify-icon icon="fa6-solid:arrow-right" width="32"></iconify-icon></a>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-service-card">
          <div class="hm-service-icon"><img src="{{ asset('frontend-assets/media/home/services/digital-marketing-icon.png') }}" alt="Digital Marketing" loading="lazy" decoding="async"></div>
          <h3>Digital Marketing</h3>
          <p>Driving growth through strategic digital marketing solutions, tailored to boost your online presence and engagement.</p>
          <a href="{{ url('/digital-marketing') }}" class="hm-service-arrow"><iconify-icon icon="fa6-solid:arrow-right" width="32"></iconify-icon></a>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-service-card">
          <div class="hm-service-icon"><img src="{{ asset('frontend-assets/media/home/services/content-strategy-icon.png') }}" alt="Content Strategy" loading="lazy" decoding="async"></div>
          <h3>Content Strategy</h3>
          <p>Crafting impactful content strategies to effectively communicate your brand's story and engage your audience.</p>
          <a href="{{ url('/seo-services') }}" class="hm-service-arrow"><iconify-icon icon="fa6-solid:arrow-right" width="32"></iconify-icon></a>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-service-card">
          <div class="hm-service-icon"><img src="{{ asset('frontend-assets/media/home/services/framework-development-icon.png') }}" alt="Framework" loading="lazy" decoding="async"></div>
          <h3>Framework</h3>
          <p>Empowering web applications with robust frameworks like CodeIgniter and Laravel for seamless performance and scalability.</p>
          <a href="{{ url('/laravel-development-services') }}" class="hm-service-arrow"><iconify-icon icon="fa6-solid:arrow-right" width="32"></iconify-icon></a>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-service-card">
          <div class="hm-service-icon"><img src="{{ asset('frontend-assets/media/home/services/cms-icon.png') }}" alt="CMS Solutions" loading="lazy" decoding="async"></div>
          <h3>CMS Solutions</h3>
          <p>Providing tailored CMS solutions with platforms like WordPress, ensuring flexibility, user-friendliness, and scalability for your website.</p>
          <a href="{{ url('/wordpress-development-services') }}" class="hm-service-arrow"><iconify-icon icon="fa6-solid:arrow-right" width="32"></iconify-icon></a>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-service-card">
          <div class="hm-service-icon"><img src="{{ asset('frontend-assets/media/home/services/mern-stack-development-icon.png') }}" alt="Mern Stack" loading="lazy" decoding="async"></div>
          <h3>Mern Stack</h3>
          <p>We leverage the power of the MERN stack (MongoDB, Express.js, React.js, and Node.js) to build high-performance web applications.</p>
          <a href="{{ url('/mern-stack-development-company') }}" class="hm-service-arrow"><iconify-icon icon="fa6-solid:arrow-right" width="32"></iconify-icon></a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===================== TRUSTED CLIENTS ===================== -->
<section class="hm-clients-section">
  <div class="max-w-[1200px] mx-auto px-4 w-full">
    <div class="hm-section-head text-center">
      <span class="hm-sub-labelx">Worldwide Client Network</span>
      <h2 class="hm-clients-title">Our Trusted <span class="hm-orange">Clients</span></h2>
      <div class="hm-line mx-auto"></div>
    </div>
    <div class="hm-clients-wrap">
  <div class="hm-clients-track">

    <!-- Original Logos -->
      @foreach($homeClientLogos as $logo)
      <div class="hm-client-slide">
        <div class="hm-client-logo">
          <img src="{{ $logo->logo_url }}" alt="{{ !empty($logo->name) ? $logo->name : 'Sortiq Solutions Client Partner' }}" loading="lazy" decoding="async">
        </div>
      </div>
      @endforeach

      <!-- Duplicate Logos for Infinite Loop -->
      @foreach($homeClientLogos as $logo)
      <div class="hm-client-slide">
        <div class="hm-client-logo">
          <img src="{{ $logo->logo_url }}" alt="{{ !empty($logo->name) ? $logo->name : 'Sortiq Solutions Client Partner' }}" loading="lazy" decoding="async">
        </div>
      </div>
      @endforeach
    </div>
  </div>
      <div class="text-center mt-5">
      <a href="/clients" class="hm-btn-orange" aria-label="View all Sortiq Solutions global clients and partners">VIEW ALL CLIENTS</a>
    </div>
  </div>
</section>

<!-- ===================== EXPERTISE / BRINGING IDEAS TO LIFE ===================== -->
<section class="hm-expertise-section">
  <div class="max-w-[1200px] mx-auto px-4 w-full">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-10 items-center w-full">
      <div class="w-full text-center hm-expertise-image">
        <img src="{{ asset('frontend-assets/media/home/Explore-our-Web-Desing-Development-Projects.png') }}" alt="Our Expertise" class="img-fluid hm-expertise-img" loading="lazy" decoding="async">
      </div>
      <div class="w-full hm-expertise-copy">
        <span class="hm-sub-label">Our Expertise in IT Solutions</span>
        <h2 class="hm-expertise-title">Bringing <span class="hm-orange">Ideas to Life </span></h2>
        <!-- white accent line below heading -->
         <div class="hx-line" style="margin-bottom: 20px;"></div>
        <p class="hm-expertise-desc">Have a glimpse at the range of innovative IT solutions delivered by Sortiq Solutions Pvt Ltd. From cutting-edge web design to seamless development, we offer end-to-end services tailored to meet your business needs. Our team is dedicated to driving digital transformation through advanced technologies and creative strategies. With a focus on quality, we empower businesses to achieve sustainable growth.</p>
        <a href="/portfolios" class="hm-btn-dark mt-3 d-inline-flex">BROWSE OUR PORTFOLIO <iconify-icon icon="lucide:arrow-right" width="16"></iconify-icon></a>
      </div>
    </div>
  </div>
</section>

<!-- ===================== TESTIMONIALS ===================== -->
<section class="hm-testimonials-section">

  <div class="hm-ts-inner">

    <div class="hm-section-head">
      <h2>What Our Clients Are Saying</h2>
      <div class="hm-line"></div>
    </div>

    <div class="hm-ts-slider">

      <div class="hm-ts-track" id="hmTsTrack">

        @foreach($homeReviews as $testimonial)
          <div class="hm-ts-card">
            <div class="hm-ts-stars">
              @for($i = 0; $i < ($testimonial->rating ?? 5); $i++)&#9733;@endfor
            </div>
            <p class="hm-ts-quote">
              &ldquo; {{ strip_tags($testimonial->content) }} &rdquo;
            </p>
          </div>
          @endforeach</div>

    </div>

    <!-- USERS -->
    <div class="hm-ts-dots-container">
      <div class="hm-ts-dots" id="hmTsDots">

      @foreach($homeReviews as $index => $testimonial)
        <button class="hm-ts-thumb {{ $index === 0 ? 'active' : '' }}">
          <img src="{{ asset('frontend-assets/media/imports/sortiqsolutions/2024/12/img' . (($index % 6) + 1) . '.jpg') }}" alt="{{ !empty($testimonial->name) ? $testimonial->name : 'Client Reviewer ' . ($index + 1) }}" loading="lazy" decoding="async">
          <span>{{ $testimonial->name ?: 'Client' }}</span>
        </button>
      @endforeach
      </div>
    </div>

    <!-- PAGINATION DOTS -->
    <div class="hm-ts-pagination-dots" role="tablist" aria-label="Testimonial pagination">
      @foreach($homeReviews as $index => $testimonial)
        <button type="button" class="hm-ts-bullet {{ $index === 0 ? 'active' : '' }}" aria-label="Slide {{ $index + 1 }}"></button>
      @endforeach
    </div>
  </div>

</section>

<!-- ===================== STATS BANNER ===================== -->
<section class="hm-stats-section">
  <div class="max-w-[1200px] mx-auto px-4 w-full">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 justify-items-center text-center w-full">
      <div class="w-full">
        <div class="hm-stat-box">
          <div class="hm-stat-icon"><img src="{{ asset('frontend-assets/media/home/stats/projects-icon.png') }}" alt="Projects" loading="lazy" decoding="async"></div>
          <span class="hm-stat-num" data-target="750">0</span><span class="hm-stat-plus">+</span>
          <p>PROJECTS</p>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-stat-box">
          <div class="hm-stat-icon"><img src="{{ asset('frontend-assets/media/home/stats/happy-clients.png') }}" alt="Clients" loading="lazy" decoding="async"></div>
          <span class="hm-stat-num" data-target="225">0</span><span class="hm-stat-plus">+</span>
          <p>CLIENTS</p>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-stat-box">
          <div class="hm-stat-icon"><img src="{{ asset('frontend-assets/media/home/stats/country-vector.png') }}" alt="Countries" loading="lazy" decoding="async"></div>
          <span class="hm-stat-num" data-target="30">0</span><span class="hm-stat-plus">+</span>
          <p>COUNTRIES</p>
        </div>
      </div>
      <div class="w-full">
        <div class="hm-stat-box">
          <div class="hm-stat-icon"><img src="{{ asset('frontend-assets/media/home/stats/happy-face-icon.png') }}" alt="Happy Clients" loading="lazy" decoding="async"></div>
          <span class="hm-stat-num" data-target="150">0</span><span class="hm-stat-plus">+</span>
          <p>HAPPY CLIENTS</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===================== LATEST INSIGHTS (BLOG) ===================== -->
<section class="hm-blog-section">
  <div class="max-w-[1200px] mx-auto px-4 w-full">
    <div class="hm-section-head text-center">
      <h2>Latest Insights</h2>
      <div class="hm-line mx-auto"></div>
    </div>
    <div class="hm-blog-grid-wrap mx-auto" style="max-width: 1100px;">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 w-full">
        @foreach($homeInsights as $blog)
          @php
            $excerpt = $blog->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($blog->content), 100);
            $category = $blog->category ?: 'Uncategorized';
          @endphp
          <div class="w-full">
            <div class="hm-blog-card">
              <div class="hm-blog-img">
                <a href="{{ route('frontend.blog.show', $blog->slug) }}">
                  <img src="{{ $blog->image_url ?: asset('frontend-assets/media/blog-placeholder.jpg') }}" alt="{{ !empty($blog->title) ? $blog->title : 'Sortiq Solutions Tech Article' }}" loading="lazy" decoding="async">
                </a>
              </div>
              <div class="hm-blog-body">
                <div class="hm-blog-meta">
                  <span style="display: inline-flex; align-items: center; gap: 4px;">
                    <iconify-icon icon="lucide:clock" style="color: #ff6a00;"></iconify-icon>
                    {{ $blog->published_at ? $blog->published_at->format('F d, Y') : '' }}
                  </span>
                  <span style="display: inline-flex; align-items: center; gap: 4px; margin-left: 12px;">
                    <iconify-icon icon="lucide:folder" style="color: #ff6a00;"></iconify-icon>
                    {{ $category }}
                  </span>
                </div>
                <h3><a href="{{ route('frontend.blog.show', $blog->slug) }}">{{ $blog->title }}</a></h3>
                <p>{{ $excerpt }}</p>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
      <div class="text-center mt-5">
      <a href="/blog" class="hm-btn-orange" style="border-radius: 50px; padding: 8px 25px; font-weight: 700;" aria-label="View all latest technology and development blog insights">VIEW ALL INSIGHTS</a>
    </div>
  </div>
</section>
</div></main>
@endsection
@push('scripts')
<script>
/* ============================================================
   ULTRA-FAST NATIVE HERO SLIDER JS
   ============================================================ */
(function initHeroSlider() {
  function start() {
    var slider = document.getElementById('sqHeroSlider');
    var track = document.getElementById('sqHeroTrack');
    var prevBtn = document.getElementById('sqHeroPrev');
    var nextBtn = document.getElementById('sqHeroNext');
    var tabs = document.querySelectorAll('.sq-hero-tab-btn');
    var progressBar = document.getElementById('sqHeroProgressBar');

    if (!slider || !track) return;

    var slides = track.querySelectorAll('.sq-hero-slide');
    var total = slides.length;
    if (total <= 1) return;

    var current = 0;
    var duration = 6000;
    var progressInterval = 50;
    var elapsed = 0;
    var timer = null;
    var isPaused = false;

    // --- MULTI-LANGUAGE LIVE TYPEWRITER ENGINE (REACT | PHP | JS) ---
    var typingTimer = null;

    // 01: REACT CODE (Next.js / React 19 Frontend)
    var reactScript = [
      {
        tokens: [
          { t: "import ", c: "c-kw" },
          { t: "{ useState } ", c: "c-fn" },
          { t: "from ", c: "c-kw" },
          { t: "\"react\";", c: "c-str" }
        ]
      },
      {
        tokens: [
          { t: "export default function ", c: "c-kw" },
          { t: "SortiqApp", c: "c-fn" },
          { t: "() {", c: "" }
        ]
      },
      {
        tokens: [
          { t: "  const [live] = ", c: "" },
          { t: "useState", c: "c-fn" },
          { t: "(true);", c: "" }
        ]
      },
      {
        tokens: [
          { t: "  return <", c: "" },
          { t: "EnterpriseApp ", c: "c-cls" },
          { t: "speed=", c: "c-var" },
          { t: "\"100/100\"", c: "c-str" },
          { t: " />;", c: "" }
        ]
      },
      {
        tokens: [
          { t: "}", c: "" }
        ]
      },
      {
        isResult: true,
        tokens: [
          { t: "✔ React Live: ", c: "c-res" },
          { t: "Interactive in 0.18s", c: "c-str" }
        ]
      }
    ];

    // 02: PHP CODE (PHP 8.3 / Laravel 11 Cloud Architecture)
    var phpScript = [
      {
        tokens: [
          { t: "namespace ", c: "c-kw" },
          { t: "App\\Services;", c: "c-cls" }
        ]
      },
      {
        tokens: [
          { t: "class ", c: "c-kw" },
          { t: "CloudEngine ", c: "c-cls" },
          { t: "extends ", c: "c-kw" },
          { t: "Service ", c: "c-cls" },
          { t: "{", c: "" }
        ]
      },
      {
        tokens: [
          { t: "  public function ", c: "c-kw" },
          { t: "deploy", c: "c-fn" },
          { t: "($node) {", c: "" }
        ]
      },
      {
        tokens: [
          { t: "    $cloud = $node->", c: "c-var" },
          { t: "scale", c: "c-fn" },
          { t: "(nodes: 64);", c: "" }
        ]
      },
      {
        tokens: [
          { t: "    return $cloud->", c: "c-kw" },
          { t: "secureDeploy", c: "c-fn" },
          { t: "('AES-256');", c: "c-str" }
        ]
      },
      {
        tokens: [
          { t: "  }", c: "" }
        ]
      },
      {
        tokens: [
          { t: "}", c: "" }
        ]
      },
      {
        isResult: true,
        tokens: [
          { t: "✔ Cloud Engine: ", c: "c-res" },
          { t: "64 Nodes Live (0ms Downtime)", c: "c-str" }
        ]
      }
    ];

    // 03: JAVASCRIPT CODE (Google V8 / Real-Time Growth Analytics)
    var jsScript = [
      {
        tokens: [
          { t: "import ", c: "c-kw" },
          { t: "{ SortiqGrowth } ", c: "c-cls" },
          { t: "from ", c: "c-kw" },
          { t: "\"@sortiq/growth\";", c: "c-str" }
        ]
      },
      {
        tokens: [
          { t: "async function ", c: "c-kw" },
          { t: "trackROI", c: "c-fn" },
          { t: "(domain) {", c: "" }
        ]
      },
      {
        tokens: [
          { t: "  const report = await SortiqGrowth.", c: "" },
          { t: "audit", c: "c-fn" },
          { t: "(domain);", c: "" }
        ]
      },
      {
        tokens: [
          { t: "  return report.", c: "c-kw" },
          { t: "boost", c: "c-fn" },
          { t: "({ roas: ", c: "" },
          { t: "\"4.8x\"", c: "c-str" },
          { t: " });", c: "" }
        ]
      },
      {
        tokens: [
          { t: "}", c: "" }
        ]
      },
      {
        isResult: true,
        tokens: [
          { t: "✔ Real-time JS: ", c: "c-res" },
          { t: "+340% Traffic Spike", c: "c-str" }
        ]
      }
    ];

    var terminalScripts = [reactScript, phpScript, jsScript];

    function stopTerminalTyping() {
      if (typingTimer) {
        clearTimeout(typingTimer);
        typingTimer = null;
      }
    }

    function startTerminalTyping(slideIndex) {
      stopTerminalTyping();
      var terminalEl = document.getElementById('sqCodeTerminal' + (slideIndex + 1));
      if (!terminalEl) return;

      var script = terminalScripts[slideIndex];
      if (!script) return;

      terminalEl.innerHTML = '';

      var cursor = document.createElement('span');
      cursor.className = 'c-cursor typing';

      var lineIdx = 0;
      var tokenIdx = 0;
      var charIdx = 0;

      var currentLineEl = document.createElement('div');
      terminalEl.appendChild(currentLineEl);
      currentLineEl.appendChild(cursor);

      var currentSpan = null;

      function typeChar() {
        if (lineIdx >= script.length) {
          cursor.classList.remove('typing');
          return;
        }

        var lineData = script[lineIdx];

        if (tokenIdx >= lineData.tokens.length) {
          lineIdx++;
          tokenIdx = 0;
          charIdx = 0;
          currentSpan = null;

          if (lineIdx < script.length) {
            currentLineEl = document.createElement('div');
            if (script[lineIdx].isResult) {
              currentLineEl.style.marginTop = '6px';
            }
            terminalEl.appendChild(currentLineEl);
            currentLineEl.appendChild(cursor);
            typingTimer = setTimeout(typeChar, 70);
          } else {
            cursor.classList.remove('typing');
          }
          return;
        }

        var token = lineData.tokens[tokenIdx];

        if (charIdx === 0) {
          currentSpan = document.createElement('span');
          if (token.c) currentSpan.className = token.c;
          currentLineEl.insertBefore(currentSpan, cursor);
        }

        currentSpan.textContent += token.t.charAt(charIdx);
        charIdx++;

        if (charIdx >= token.t.length) {
          tokenIdx++;
          charIdx = 0;
          currentSpan = null;
        }

        var delay = Math.floor(Math.random() * 10) + 11;
        typingTimer = setTimeout(typeChar, delay);
      }

      typingTimer = setTimeout(typeChar, 140);
    }

    function goTo(index) {
      if (index < 0) index = total - 1;
      if (index >= total) index = 0;
      current = index;
      track.style.transform = 'translateX(-' + (current * 100) + '%)';

      slides.forEach(function(slide, i) {
        slide.classList.toggle('is-active', i === current);
      });

      tabs.forEach(function(btn, i) {
        var active = (i === current);
        btn.classList.toggle('active', active);
        btn.setAttribute('aria-selected', active ? 'true' : 'false');
      });

      elapsed = 0;
      if (progressBar) progressBar.style.width = '0%';

      startTerminalTyping(current);
    }

    function tick() {
      if (isPaused) return;
      elapsed += progressInterval;
      var pct = Math.min((elapsed / duration) * 100, 100);
      if (progressBar) progressBar.style.width = pct + '%';

      if (elapsed >= duration) {
        goTo(current + 1);
      }
    }

    function startAutoplay() {
      stopAutoplay();
      timer = setInterval(tick, progressInterval);
    }

    function stopAutoplay() {
      if (timer) {
        clearInterval(timer);
        timer = null;
      }
    }

    if (prevBtn) {
      prevBtn.addEventListener('click', function() {
        goTo(current - 1);
      });
    }

    if (nextBtn) {
      nextBtn.addEventListener('click', function() {
        goTo(current + 1);
      });
    }

    tabs.forEach(function(btn) {
      btn.addEventListener('click', function() {
        var idx = parseInt(this.getAttribute('data-slide-index'), 10);
        if (!isNaN(idx)) goTo(idx);
      });
    });

    slider.addEventListener('mouseenter', function() {
      isPaused = true;
    });

    slider.addEventListener('mouseleave', function() {
      isPaused = false;
    });

    document.addEventListener('visibilitychange', function() {
      isPaused = document.hidden;
    });

    // Touch swipe support
    var touchStartX = 0;
    var touchEndX = 0;
    slider.addEventListener('touchstart', function(e) {
      touchStartX = e.changedTouches[0].screenX;
      isPaused = true;
    }, { passive: true });

    slider.addEventListener('touchend', function(e) {
      touchEndX = e.changedTouches[0].screenX;
      isPaused = false;
      var diff = touchStartX - touchEndX;
      if (Math.abs(diff) > 40) {
        if (diff > 0) {
          goTo(current + 1);
        } else {
          goTo(current - 1);
        }
      }
    }, { passive: true });

    goTo(0);
    startAutoplay();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', start);
  } else {
    start();
  }
})();

/* ============================================================
   HOMEPAGE SCRIPTS
   ============================================================ */

/* ---- Video Lightbox Modal ---- */
(function() {
  var modal = document.getElementById('sqVideoModal');
  var container = document.getElementById('sqVideoContainer');
  var titleEl = document.getElementById('sqVideoModalTitle');
  if (!modal || !container) return;

  function openVideoModal(triggerEl) {
    var rawUrl = triggerEl.getAttribute('data-playback-url') || '';
    var type = triggerEl.getAttribute('data-playback-type') || 'youtube';
    var title = triggerEl.getAttribute('data-video-title') || 'Sortiq Solutions Video';

    if (!rawUrl) return;

    if (titleEl) {
      titleEl.textContent = title;
    }

    container.innerHTML = '';

    if (type === 'file') {
      var video = document.createElement('video');
      video.src = rawUrl;
      video.title = title;
      video.controls = true;
      video.autoplay = true;
      video.playsInline = true;
      video.setAttribute('playsinline', '');
      container.appendChild(video);
      video.play().catch(function() {});
    } else {
      var embedUrl = rawUrl;
      if (embedUrl.indexOf('youtube.com/watch?v=') !== -1) {
        var parts = embedUrl.split('v=');
        if (parts[1]) {
          var vId = parts[1].split('&')[0];
          embedUrl = 'https://www.youtube.com/embed/' + vId;
        }
      } else if (embedUrl.indexOf('youtu.be/') !== -1) {
        var parts = embedUrl.split('youtu.be/');
        if (parts[1]) {
          var vId = parts[1].split('?')[0];
          embedUrl = 'https://www.youtube.com/embed/' + vId;
        }
      }

      var sep = embedUrl.indexOf('?') === -1 ? '?' : '&';
      embedUrl += sep + 'autoplay=1&playsinline=1&rel=0&modestbranding=1';

      var iframe = document.createElement('iframe');
      iframe.src = embedUrl;
      iframe.title = title;
      iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share';
      iframe.allowFullscreen = true;
      iframe.setAttribute('allowfullscreen', '');
      container.appendChild(iframe);
    }

    modal.classList.add('is-active');
    modal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  }

  function closeVideoModal() {
    modal.classList.remove('is-active');
    modal.setAttribute('aria-hidden', 'true');
    container.innerHTML = '';
    document.body.style.overflow = '';
  }

  document.querySelectorAll('[data-video-open]').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      openVideoModal(this);
    });
  });

  modal.querySelectorAll('[data-close-video-modal]').forEach(function(el) {
    el.addEventListener('click', function(e) {
      e.preventDefault();
      closeVideoModal();
    });
  });

  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && modal.classList.contains('is-active')) {
      closeVideoModal();
    }
  });
})();

(function() {
  var track = document.querySelector('.hm-clients-track');
  if (!track) return;

  function scrollCards(direction) {
    var step = track.clientWidth * 0.8;
    var nextPos = direction === 'prev' ? track.scrollLeft - step : track.scrollLeft + step;
    if (nextPos >= track.scrollWidth - track.clientWidth) {
      nextPos = 0;
    }
    if (nextPos < 0) {
      nextPos = track.scrollWidth - track.clientWidth;
    }
    track.scrollTo({ left: nextPos, behavior: 'smooth' });
  }

  var autoId = setInterval(function() { scrollCards('next'); }, 3500);
  track.addEventListener('mouseenter', function() { clearInterval(autoId); });
  track.addEventListener('mouseleave', function() { autoId = setInterval(function() { scrollCards('next'); }, 3500); });
})();

/* ---- Counter Animation ---- */
(function() {
  var counters = document.querySelectorAll('.hm-stat-num');
  if (!counters.length) return;

  var observed = false;
  var observer = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
      if (entry.isIntersecting && !observed) {
        observed = true;
        counters.forEach(function(el) {
          var target = parseInt(el.getAttribute('data-target'), 10);
          var duration = 1800;
          var step = Math.ceil(target / (duration / 16));
          var current = 0;
          var timer = setInterval(function() {
            current += step;
            if (current >= target) { current = target; clearInterval(timer); }
            el.textContent = current;
          }, 16);
        });
      }
    });
  }, { threshold: 0.4 });

  var statsSection = document.querySelector('.hm-stats-section');
  if (statsSection) observer.observe(statsSection);
})();

(function() {
  var section = document.querySelector('.hm-expertise-section');
  if (!section) return;
  var observer = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
      if (entry.isIntersecting) {
        section.classList.add('is-visible');
        observer.unobserve(section);
      }
    });
  }, { threshold: 0.2 });
  observer.observe(section);
})();

/* ---- Services Reveal ---- */
(function() {
  var section = document.querySelector('.hm-services-section');
  if (!section) return;
  var observer = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
      if (entry.isIntersecting) {
        section.classList.add('is-visible');
        observer.unobserve(section);
      }
    });
  }, { threshold: 0.15 });
  observer.observe(section);
})();

(function initCertSlider() {
  function start() {
    var track = document.querySelector(".hm-cert-track");
    var viewport = document.querySelector(".hm-cert-viewport");
    var dotsWrap = document.querySelector(".hm-cert-dots");
    var prevBtn = document.querySelector(".hm-cert-prev");
    var nextBtn = document.querySelector(".hm-cert-next");
    var slider = document.querySelector(".hm-cert-slider");

    if (!track || !viewport) return;
    if (track.dataset.certInitialized === "true") return;
    track.dataset.certInitialized = "true";

    var originalCards = Array.from(track.querySelectorAll(".hm-cert-card"));
    var N = originalCards.length;
    if (N === 0) return;

    // Clone all original cards before and after for true infinite sliding
    var firstOriginal = originalCards[0];
    originalCards.forEach(function (card) {
      var clone = card.cloneNode(true);
      clone.setAttribute("aria-hidden", "true");
      clone.classList.add("hm-cert-clone");
      track.insertBefore(clone, firstOriginal);
    });

    originalCards.forEach(function (card) {
      var clone = card.cloneNode(true);
      clone.setAttribute("aria-hidden", "true");
      clone.classList.add("hm-cert-clone");
      track.appendChild(clone);
    });

    // Track now has 3*N cards: [c0..c(N-1), o0..o(N-1), a0..a(N-1)]
    // Initial current index is N (pointing to the original set)
    var current = N;
    var isMoving = false;
    var timer = null;
    var unlockTimeout = null;

    function getStep() {
      var allCards = track.querySelectorAll(".hm-cert-card");
      if (allCards.length >= 2) {
        var diff = allCards[1].offsetLeft - allCards[0].offsetLeft;
        if (diff > 0) return diff;
      }
      var first = allCards[0];
      if (first && first.offsetWidth > 0) {
        var gap = parseFloat(window.getComputedStyle(track).gap) || 24;
        return first.offsetWidth + gap;
      }
      return viewport.clientWidth > 0 ? ((viewport.clientWidth + 24) / 3) : 380;
    }

    function setPosition(index, animate) {
      if (animate) {
        track.style.transition = "transform 0.65s cubic-bezier(0.25, 1, 0.5, 1)";
      } else {
        track.style.transition = "none";
      }
      var step = getStep();
      track.style.transform = "translateX(-" + (index * step) + "px)";
    }

    function getActiveDotIndex(idx) {
      return ((idx - N) % N + N) % N;
    }

    function updateDots() {
      if (!dotsWrap) return;
      var activeIdx = getActiveDotIndex(current);
      Array.from(dotsWrap.children).forEach(function (dot, i) {
        dot.classList.toggle("active", i === activeIdx);
      });
    }

    function renderDots() {
      if (!dotsWrap) return;
      dotsWrap.innerHTML = "";
      for (var i = 0; i < N; i++) {
        var dot = document.createElement("button");
        dot.type = "button";
        dot.className = "hm-cert-dot" + (i === 0 ? " active" : "");
        dot.setAttribute("aria-label", "Show certificate " + (i + 1));
        dot.dataset.index = i;
        dot.addEventListener("click", function () {
          if (isMoving) return;
          var target = Number(this.dataset.index);
          current = N + target;
          isMoving = true;
          setPosition(current, true);
          updateDots();
          restartAutoplay();
        });
        dotsWrap.appendChild(dot);
      }
    }

    function slideNext() {
      if (isMoving) return;
      isMoving = true;
      current++;
      setPosition(current, true);
      updateDots();

      clearTimeout(unlockTimeout);
      unlockTimeout = setTimeout(function () {
        if (isMoving) handleLoopReset();
      }, 700);
    }

    function slidePrev() {
      if (isMoving) return;
      isMoving = true;
      current--;
      setPosition(current, true);
      updateDots();

      clearTimeout(unlockTimeout);
      unlockTimeout = setTimeout(function () {
        if (isMoving) handleLoopReset();
      }, 700);
    }

    function handleLoopReset() {
      isMoving = false;
      clearTimeout(unlockTimeout);
      if (current >= 2 * N) {
        current = current - N;
        setPosition(current, false);
        void track.offsetHeight;
      } else if (current < N) {
        current = current + N;
        setPosition(current, false);
        void track.offsetHeight;
      }
      updateDots();
    }

    track.addEventListener("transitionend", function (e) {
      if (e.target !== track || e.propertyName !== "transform") return;
      handleLoopReset();
    });

    if (nextBtn) {
      nextBtn.addEventListener("click", function () {
        slideNext();
        restartAutoplay();
      });
    }

    if (prevBtn) {
      prevBtn.addEventListener("click", function () {
        slidePrev();
        restartAutoplay();
      });
    }

    function restartAutoplay() {
      clearInterval(timer);
      timer = setInterval(slideNext, 2500);
    }

    function pauseAutoplay() {
      clearInterval(timer);
    }

    if (slider) {
      slider.addEventListener("mouseenter", pauseAutoplay);
      slider.addEventListener("mouseleave", restartAutoplay);
    }

    // Touch Swipe
    var touchStartX = 0;
    var touchStartY = 0;
    viewport.addEventListener("touchstart", function (e) {
      pauseAutoplay();
      if (e.touches.length === 1) {
        touchStartX = e.touches[0].clientX;
        touchStartY = e.touches[0].clientY;
      }
    }, { passive: true });

    viewport.addEventListener("touchend", function (e) {
      if (e.changedTouches.length === 1) {
        var diffX = touchStartX - e.changedTouches[0].clientX;
        var diffY = touchStartY - e.changedTouches[0].clientY;
        if (Math.abs(diffX) > Math.abs(diffY) && Math.abs(diffX) > 40) {
          if (diffX > 0) {
            slideNext();
          } else {
            slidePrev();
          }
        }
      }
      restartAutoplay();
    }, { passive: true });

    document.addEventListener("visibilitychange", function () {
      if (document.hidden) {
        pauseAutoplay();
      } else {
        restartAutoplay();
      }
    });

    window.addEventListener("resize", function () {
      setPosition(current, false);
    });

    window.addEventListener("load", function () {
      setPosition(current, false);
    });

    renderDots();
    setPosition(current, false);
    restartAutoplay();
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", start);
  } else {
    start();
  }
})();

(function initTestimonialSlider() {
  function start() {
    var track = document.getElementById("hmTsTrack");
    var thumbs = document.querySelectorAll(".hm-ts-thumb");
    var cards = track ? Array.from(track.querySelectorAll(".hm-ts-card")) : [];
    var slider = document.querySelector(".hm-ts-slider");
    if (!track || !cards.length || !thumbs.length || !slider) return;
    if (track.dataset.tsInitialized === "true") return;
    track.dataset.tsInitialized = "true";

    // INFINITE LOOP SETUP: Clone elements for seamless transition
    var firstClone = cards[0].cloneNode(true);
    var lastClone = cards[cards.length - 1].cloneNode(true);
    track.appendChild(firstClone);
    track.insertBefore(lastClone, track.firstChild);

    // Update cards array to include clones
    var allCards = Array.from(track.querySelectorAll(".hm-ts-card"));
    var totalReal = cards.length;
    var current = 1; // Start at the first real card (after the lastClone)
    var isTransitioning = false;

    function getStep() {
      var style = window.getComputedStyle(allCards[0]);
      var margin = parseFloat(style.marginLeft || 0) + parseFloat(style.marginRight || 0);
      return allCards[0].offsetWidth + margin;
    }

    function updateSliderHeight(animate) {
      if (!slider) return;
      var activeCard = allCards[current];
      if (!activeCard) return;

      var cardHeight = activeCard.offsetHeight;
      if (!cardHeight) {
        var quote = activeCard.querySelector(".hm-ts-quote");
        if (quote) {
          var cs = window.getComputedStyle(activeCard);
          var padTop = parseFloat(cs.paddingTop || 0);
          var padBottom = parseFloat(cs.paddingBottom || 0);
          cardHeight = quote.offsetHeight + padTop + padBottom;
        }
      }

      if (cardHeight > 0) {
        slider.style.transition = animate ? "height 0.4s ease" : "none";
        slider.style.height = cardHeight + "px";
      }
    }

    function moveSlide(index, animate = true) {
      if (isTransitioning && animate) return;
      if (animate) isTransitioning = true;

      current = index;
      var step = getStep();
      var sliderWidth = slider.offsetWidth;
      var cardWidth = allCards[current].offsetWidth;
      
      // Centering the current card
      var mainTranslateX = (sliderWidth / 2) - (cardWidth / 2) - (current * step);
      
      track.style.transition = animate ? "transform .85s cubic-bezier(.16, 1, .3, 1)" : "none";
      track.style.transform = "translateX(" + mainTranslateX + "px)";

      // Auto-set slider height to the exact active card/paragraph height
      updateSliderHeight(animate);

      // Update active states
      var realIdx = (current - 1 + totalReal) % totalReal;
      
      allCards.forEach(function(card, idx) {
        card.classList.toggle("active", idx === current);
      });

      thumbs.forEach(function(thumb, idx) {
        var isCenter = (idx === realIdx);
        var isPrev = (idx === (realIdx - 1 + totalReal) % totalReal);
        var isNext = (idx === (realIdx + 1) % totalReal);
        
        thumb.classList.toggle("active", isCenter);
        
        // Only show current, previous and next
        if (isCenter || isPrev || isNext) {
          thumb.style.display = "flex";
          thumb.style.opacity = isCenter ? "1" : "0.4";
          thumb.style.filter = isCenter ? "blur(0)" : "blur(1px)";
          
          // Order them: prev, center, next
          if (isPrev) thumb.style.order = "1";
          if (isCenter) thumb.style.order = "2";
          if (isNext) thumb.style.order = "3";
        } else {
          thumb.style.display = "none";
        }
      });

      // Centers the 3-item dots container
      var dotsContainer = document.getElementById("hmTsDots");
      if (dotsContainer) {
        dotsContainer.style.justifyContent = "center";
        dotsContainer.style.transform = "none";
        dotsContainer.style.width = "auto";
        dotsContainer.style.margin = "auto";
      }

      // Sync pagination bullets
      var bullets = document.querySelectorAll(".hm-ts-bullet");
      if (bullets.length) {
        bullets.forEach(function(b, idx) {
          b.classList.toggle("active", idx === realIdx);
        });
      }
    }

    // Handle seamless snap-back at the end of transition
    track.addEventListener("transitionend", function() {
      isTransitioning = false;
      if (current === 0) {
        moveSlide(totalReal, false);
      } else if (current === totalReal + 1) {
        moveSlide(1, false);
      }
    });

    thumbs.forEach(function(thumb, idx) {
      thumb.addEventListener("click", function() {
        moveSlide(idx + 1);
      });
    });

    var bullets = document.querySelectorAll(".hm-ts-bullet");
    bullets.forEach(function(bullet, idx) {
      bullet.addEventListener("click", function() {
        moveSlide(idx + 1);
      });
    });

    window.addEventListener("resize", function() {
      moveSlide(current, false);
    });

    // Initial call
    moveSlide(1, false);
    setTimeout(function() { updateSliderHeight(false); }, 150);
    window.addEventListener("load", function() { updateSliderHeight(false); });

    // Auto-play
    setInterval(function() {
      if (!isTransitioning) moveSlide(current + 1);
    }, 6000);
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", start);
  } else {
    start();
  }
})();
</script>
@endpush