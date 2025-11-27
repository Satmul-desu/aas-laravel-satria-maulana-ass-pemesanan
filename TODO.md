# TODO List for "Pesan Permohonan Pembayaran" Feature

## Completed
- Create PaymentRequestController with relevant methods (create, store, bayar)
- Develop form blade view for permohonan pembayaran (resources/views/payment_requests/create.blade.php)
- Add routes for permohonan pembayaran form display, submission, and pembayaran action
- Update pemesanans index blade to add:
  - Button to access permohonan pembayaran form
  - "Bayar" button on pemesanan with jenis_layanan 'permohonan pembayaran' and status 'pending pesan'
- Implement logic to update Saldo on pembayaran

## Next Steps
- Test using permohonan pembayaran form creation, list view, and pembayaran function
- Verify uang kerugian (saldo) updates correctly
- Handle error/success messages properly in UI
- Enhance UI/UX if needed
- Add scoped queries or filters in pemesanan listing if required
- Add authorization checks on controller methods if needed
- Write automated tests for the new feature (optional)
