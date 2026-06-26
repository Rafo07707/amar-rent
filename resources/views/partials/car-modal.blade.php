{{-- Global car details modal overlay — included in layout.blade.php so it works on every page --}}
<div class="car-modal-overlay" id="carModalOverlay" aria-modal="true" role="dialog">
  <div class="car-modal" id="carModalInner">
    <button type="button" class="car-modal-close" id="carModalClose" aria-label="Close"><i class="ti ti-x"></i></button>
    <div id="carModalContent"></div>
  </div>
</div>

@push('scripts')
<script>
(function() {
  const overlay = document.getElementById('carModalOverlay');
  const modal   = document.getElementById('carModalInner');
  if (!overlay) return;

  const i18n = {
    fullInsurance:   @json(__('site.adv_insurance_title')),
    noHiddenFees:    @json(__('site.adv_fees_title')),
    freeCancel:      @json(__('site.adv_cancel_title')),
    personalManager: @json(__('site.adv_support_title')),
    deposit:         @json(__('site.car_deposit_label')),
    refundable:      @json(__('site.refundable')),
    includedMileage: @json(__('site.included_mileage')),
    extrasTitle:     @json(__('site.extras_title')),
    bookNow:         @json(__('site.book')),
    perDay:          @json(__('site.per_day')),
    unlimited:       @json(__('site.unlimited_mileage')),
    seats:           @json(__('site.seats')),
    bags:            @json(__('admin.car_bags')),
  };

  // Extras loaded once from the page-level JSON blob injected by car-card buttons
  // Each [data-open-car-modal] button carries a data-car JSON attribute with all needed info
  function openModal(btn) {
    let car;
    try { car = JSON.parse(btn.dataset.car); } catch(e) { return; }

    const imgHtml = car.image
      ? `<img src="${car.image}" class="car-modal-img" alt="${car.name}" loading="lazy">`
      : `<div class="car-modal-img"><i class="ti ti-car"></i></div>`;

    const extrasHtml = (car.extras || []).map(e =>
      `<div class="car-modal-extra-row">
        <span><i class="${e.icon}"></i> ${e.name}</span>
        <span class="car-modal-extra-price">${e.price}${e.per_day ? ' / ' + i18n.perDay.replace('/ ','') : ''}</span>
      </div>`
    ).join('');

    document.getElementById('carModalContent').innerHTML = `
      <p class="eyebrow">${car.category}</p>
      <h2 style="margin-bottom:20px;">${car.name}</h2>
      ${imgHtml}
      <div class="car-modal-highlights">
        <div class="car-modal-highlight"><i class="ti ti-circle-check"></i> ${i18n.fullInsurance}</div>
        <div class="car-modal-highlight"><i class="ti ti-circle-check"></i> ${i18n.noHiddenFees}</div>
        <div class="car-modal-highlight"><i class="ti ti-circle-check"></i> ${i18n.freeCancel}</div>
        <div class="car-modal-highlight"><i class="ti ti-circle-check"></i> ${i18n.personalManager}</div>
      </div>
      <div class="car-modal-info-box">
        <strong>${i18n.includedMileage}:</strong>
        ${car.km > 0 ? car.km + ' km/day' : i18n.unlimited}
        &nbsp;·&nbsp; <strong>${car.seats}</strong> ${i18n.seats}
        &nbsp;·&nbsp; <strong>${car.bags}</strong> ${i18n.bags}
      </div>
      <div class="car-modal-info-box">
        <strong>${i18n.deposit}:</strong> ${car.deposit}
        <span style="color:#2C9C68;">(${i18n.refundable})</span>
      </div>
      ${extrasHtml.length ? `<h3 style="margin:24px 0 10px;font-size:1.05rem;">${i18n.extrasTitle}</h3><div class="car-modal-extras">${extrasHtml}</div>` : ''}
      <a href="${car.bookUrl}" class="btn btn-primary"
         style="width:100%;justify-content:center;margin-top:24px;">
        ${i18n.bookNow} — ${car.price}
      </a>`;

    overlay.classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function closeModal() {
    overlay.classList.remove('open');
    document.body.style.overflow = '';
    modal.style.transform = '';
  }

  // Event delegation — works for buttons added at any time (home featured + fleet grid)
  document.addEventListener('click', function(e) {
    const btn = e.target.closest('[data-open-car-modal]');
    if (btn) { e.preventDefault(); openModal(btn); return; }
    if (e.target === overlay) closeModal();
    if (e.target.closest('#carModalClose')) closeModal();
  });

  // Keyboard: ESC to close
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && overlay.classList.contains('open')) closeModal();
  });

  // Swipe-down to dismiss (mobile bottom-sheet)
  let startY = 0, dragging = false;
  modal.addEventListener('touchstart', function(e) {
    if (window.innerWidth > 760) return;
    startY  = e.touches[0].clientY;
    dragging = true;
    modal.style.transition = 'none';
  }, { passive: true });

  modal.addEventListener('touchmove', function(e) {
    if (!dragging) return;
    const dy = e.touches[0].clientY - startY;
    if (dy > 0) modal.style.transform = `translateY(${dy}px)`;
  }, { passive: true });

  modal.addEventListener('touchend', function(e) {
    if (!dragging) return;
    dragging = false;
    modal.style.transition = '';
    const dy = e.changedTouches[0].clientY - startY;
    modal.style.transform = '';
    if (dy > 110) closeModal();
  });
})();
</script>
@endpush
