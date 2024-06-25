import React from 'react';
import ReactDOM from 'react-dom/client';
import './index.css';
import './showDetail.css'
import App from './App';
import 'bootstrap/dist/css/bootstrap.min.css';
import { LoginProvider } from './context/LoginContext';



import {BrowserRouter} from 'react-router-dom'
ReactDOM.createRoot(document.getElementById('root')).render(
  <BrowserRouter>
  <LoginProvider>
    <App />
  </LoginProvider>
  </BrowserRouter>,
)


