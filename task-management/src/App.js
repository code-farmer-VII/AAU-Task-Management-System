// App.js
import React from 'react';
import { Routes, Route} from 'react-router-dom';
import Home from './page/home';
import Manager from './managerComponent/manager';
import Register from './managerComponent/rigister';
import TaskAdd from './managerComponent/addTask';
import Employee from './employeeComponent/employee';
import ShowDetail from './managerComponent/showDetail';
import AsignedTasks from './managerComponent/asignedTasks';

function App() {
  return (
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/manager" element={<Manager/>} />
        <Route path='/employee' element={<Employee/>} />
        <Route path="/manager/register/:id" element={<Register />} />
        <Route path='/manager/addTask/:id' element={<TaskAdd/>} />
        <Route path='/manager/showdetail/:id' element={<ShowDetail/>} />
        <Route path='/manager/AsignedTasks/:id' element={<AsignedTasks/>} />
      </Routes>
  );
}

export default App;
