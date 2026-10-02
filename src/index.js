import './publicPath';
import React from 'react';
import ReactDOM from 'react-dom/client';
import Modal from 'react-modal';
import App from './App';

const container = document.getElementById('root-pray-for-us');

if (container) {
  Modal.setAppElement(container);
  ReactDOM.createRoot(container).render(
    <React.StrictMode>
      <App />
    </React.StrictMode>
  );
}
