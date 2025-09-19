import axios from 'axios';

// Get the backend URL from environment variable
const API_BASE_URL = import.meta.env.VITE_API_URL || 'http://localhost:8000/api';

// Create axios instance
const api = axios.create({
  baseURL: API_BASE_URL,
  headers: {
    'Content-Type': 'application/json',
  },
});

// Request interceptor to add auth token
api.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem('auth_token');
    if (token && config.headers) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
  },
  (error) => {
    return Promise.reject(error);
  }
);

// Response interceptor to handle auth errors
api.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response?.status === 401) {
      // Token expired or invalid, redirect to login
      localStorage.removeItem('auth_token');
      localStorage.removeItem('user');
      window.location.href = '/login';
    }
    return Promise.reject(error);
  }
);

// API endpoints
export const authAPI = {
  register: (data: {
    name: string;
    email: string;
    password: string;
    password_confirmation: string;
  }) => api.post('/auth/register', data),
  
  login: (data: { email: string; password: string }) => 
    api.post('/auth/login', data),
  
  logout: () => api.post('/auth/logout'),
  
  getUser: () => api.get('/auth/user'),
  
  refresh: () => api.post('/auth/refresh'),
};

export default api;