<?php
$settings = $this->get_settings_for_display();

?>

<style>
.x-studioapp-open-canvas-menu i {
  cursor: pointer !important;
}
.x-studioapp-drawer-overlay {
  background-color: black;
  position: fixed !important;
  top: 0 !important;
  bottom: 0 !important;
  right: 0 !important;
  left: 0 !important;
  opacity: 1;
  z-index: 1000 !important;
  transition: transform 0.7s ease, opacity 0.7s ease !important;
  transform: translateX(100%) !important;
}
.x-studioapp-drawer-overlay-open {
  transform: translateX(0) !important;
  opacity: 0.95 !important;
}
</style>

<div class="x-studioapp-drawer">
  <div>
    <p class="x-studioapp-open-canvas-menu">
      <i data-canvas-trigger="true" style="cursor:pointer;">Click</i>
    </p>
  </div>
</div>
<div class="x-studioapp-drawer-overlay">
</div>
