
import React, { createContext, useState, useContext } from 'react';

const ContextProvider = createContext();

export const LoginProvider = ({ children }) => {
  const [LoginData, setLoginData] = useState(null);

  return (
    <ContextProvider.Provider value={{ LoginData, setLoginData }}>
      {children}
    </ContextProvider.Provider>
  );
};

export const useLogin = () => useContext(ContextProvider);
