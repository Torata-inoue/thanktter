import React from 'react';
import ReactDOM from 'react-dom/client';

const App: React.FC = () => {
  return <div>Hello Laravel & React &TS</div>
}

ReactDOM.createRoot(document.getElementById('react-root') as HTMLElement).render(
  <React.StrictMode>
    <App />
  </React.StrictMode>
);
