import React, { useState } from 'react';
import { BrowserRouter, Routes, Route } from "react-router-dom";
import Home from './homeComponent/Home';
import TentForm from './formComponent/TentForm';
import NavBar from './component/NavBar';
import { TentProvider } from './store/Store';
import ThankYouPage from './component/ThankYouPage';
import DownloadReceipt from './component/DownloadReceipt';
import CancelBooking from './component/CancelBooking';
import BookTent from './bookingComponent/BookTent';
import ReceiptModal from './modalComponent/ReceiptModal';
import RedirectComponent from './redirectComponent/RedirectComponent';
import WelcomeTentModal from './modalComponent/WelcomeTentModal';

const App: React.FC = () => {
  const [modalOpen, setModalOpen] = useState(true);

  const handleOpen = () => setModalOpen(true);
  const handleClose = () => setModalOpen(false);
  return (
    <>
      <TentProvider>
        <BrowserRouter>
          <NavBar />
          <div>
            <Routes>
              <Route path="/" element={<BookTent />} />
              <Route path="/tent-form" element={<TentForm />} />
              <Route path='/thank-you-page' element={<ThankYouPage />} />
              <Route path='/download-receipt' element={<DownloadReceipt />} />
              <Route path='/cancel-booking' element={<CancelBooking />} />
              <Route path="/redirect-page" element={<RedirectComponent />} />
              <Route path='/receipt' element={<ReceiptModal mobile='23' />} />
              <Route path='/welcome' element={<WelcomeTentModal open={modalOpen} onClose={handleClose} />
              } />
            </Routes>
          </div>
        </BrowserRouter>
      </TentProvider>
    </>
  );
}

export default App;
