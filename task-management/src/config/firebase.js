import { initializeApp } from "firebase/app";
import {getAuth} from 'firebase/auth';
import { getFirestore } from "firebase/firestore";
import { getStorage } from "firebase/storage";

const firebaseConfig = {
    apiKey: "AIzaSyC_-93h2c3mK2LCUyXWRHVdphoM7yMejl0",
    authDomain: "task-management-d7461.firebaseapp.com",
    projectId: "task-management-d7461",
    storageBucket: "task-management-d7461.appspot.com",
    messagingSenderId: "232904507936",
    appId: "1:232904507936:web:258550888a6f2265eab245"
  };

const app = initializeApp(firebaseConfig);

export const db = getFirestore(app);
export const authenticate = getAuth(app)
export const storage= getStorage(app)