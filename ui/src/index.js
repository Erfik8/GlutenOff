import React from "react";
import { BrowserRouter as Router, Route, Routes } from "react-router-dom";
import LoginPage from "./LoginPage.js"; 
import RegisterPage from "./RegisterPage.js";
import Dashboard from "./Dashboard/Dashboard.js";
import ReactDOM from 'react-dom/client';
import ProductInformation from "./Mobile/ProductInformation.js";
import ShopInformation from "./Mobile/ShopInformation.js";
import UserSettingsPage from "./UserSettings/userSettingsPage.js";
import ProductInfoPage from "./Info/ProductInfoPage.js";

const root = ReactDOM.createRoot(document.getElementById('login'));
root.render(
  <React.StrictMode>
    <Router>
      <Routes>
        <Route path="/" element={<LoginPage />} />
        <Route path="/login" element={<LoginPage />} />
        <Route path="/register" element={<RegisterPage />} />
        <Route path="/dashboard" element={<Dashboard />} />
        <Route path="/products" element={<ProductInfoPage />} />
        <Route path="/shops" element={<ShopInformation />} />
        <Route path="/userSettings" element={<UserSettingsPage />} />
        <Route path="/addProduct" element={<ProductInfoPage />} />
      </Routes>
    </Router>
  </React.StrictMode>
);