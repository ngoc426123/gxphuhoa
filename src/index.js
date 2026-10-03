import './publicPath';
import React from 'react';
import ReactDOM from 'react-dom/client';
import Modal from 'react-modal';
import App from './App';
import AppToday from './AppToday';

const container = document.getElementById('root-pray-for-us');

if (container) {
  Modal.setAppElement(container);
  ReactDOM.createRoot(container).render(
    <React.StrictMode>
      <App />
    </React.StrictMode>
  );
}

const containerToday = document.getElementById('root-pray-for-us-today');

if (containerToday) {
  ReactDOM.createRoot(containerToday).render(
    <React.StrictMode>
      <AppToday />
    </React.StrictMode>
  );
}
