
document.addEventListener('DOMContentLoaded', function() {
  const checkbox = document.querySelector('input[name="debug"]');
  const debugSection = document.getElementById('debug-section');
  if (checkbox && debugSection) {


    
    checkbox.addEventListener('change', function() {
      debugSection.classList.toggle('hidden', !this.checked);
    });
  }
});