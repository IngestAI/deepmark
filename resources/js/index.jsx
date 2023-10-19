import React from 'react';
import { createRoot } from 'react-dom/client';
import { BrowserRouter } from 'react-router-dom';
import { App } from './App';

const APP_CONTAINER = document.getElementById('root');

if (APP_CONTAINER) {
    const root = createRoot(APP_CONTAINER);
    root.render(
        <BrowserRouter>
            <App />
        </BrowserRouter>
    )
}
