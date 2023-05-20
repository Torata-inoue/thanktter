import React from 'react';
import ReactDOM from 'react-dom/client';

export const App: React.FC = () => {
  return <div>Hello & React &TS &Vite Hello thnaks</div>
}

ReactDOM.createRoot(document.getElementById('react-root') as HTMLElement).render(
  <React.StrictMode>
    <App />
  </React.StrictMode>
);
