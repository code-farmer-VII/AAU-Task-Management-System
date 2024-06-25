import React, { useState, useEffect } from "react";
import {
  Navbar,
  Container,
  Nav,
  Offcanvas,
  Table,
  Button,
} from "react-bootstrap";
import { collection, query, where, getDocs } from "firebase/firestore";
import { db } from "../config/firebase";
import { useLogin } from "../context/LoginContext";
import { useNavigate } from "react-router-dom";
import { DeleteEmployee } from "./deleteEmployee";

//import { authenticate } from '../config/firebase';
//import {deleteUser} from 'firebase/auth';

function Manager() {
  const [showSidebar, setShowSidebar] = useState(false);
  const [employees, setEmployees] = useState([]);
  const { LoginData, setLoginData } = useLogin();
  const handleClose = () => setShowSidebar(false);
  const handleShow = () => setShowSidebar(true);
  const navigate = useNavigate();

  const [showOffcanvas, setShowOffcanvas] = useState(false);

  const handleDeleteClose = () => setShowOffcanvas(false);
  //const handleDeleteShow = () => setShowOffcanvas(true);

  const AssignTask = (uid) => {
    alert(uid);
    navigate(`/manager/addTask/${uid}`);
  };

  const handleAsignedTasks=(uid)=>{
      alert(uid)
      navigate(`/manager/AsignedTasks/${uid}`)
  }

  useEffect(() => {
    const storedLoginData = localStorage.getItem("loginData");
    if (storedLoginData) {
      setLoginData(JSON.parse(storedLoginData));
    }

    const fetchData = async () => {
      try {
        const myCollection = collection(db, "employee");
        // const myQuery = query(myCollection, where('position', '!=', 'manager'));
        const querySnapshot = await getDocs(myCollection);
        const employeeData = querySnapshot.docs.map((doc) => ({
          id: doc.id,
          uid: doc.id,
          ...doc.data(),
        }));
        setEmployees(employeeData);
        console.log(employeeData);
      } catch (error) {
        console.error("Error getting documents: ", error);
      }
    };
    fetchData();
  }, [setLoginData]);

  const registerMove = (uid) => {
    alert(`${uid}`);
    navigate(`/manager/register/${uid}`);
  };

  const signout = async () => {
    try {
      const myCollection = collection(db, "employee");
      const managerQuery = query(
        myCollection,
        where("position", "==", "manager")
      );
      const managerSnapshot = await getDocs(managerQuery);
      if (managerSnapshot.docs.length > 1) {
        localStorage.removeItem("loginData");
        setLoginData(null);
        navigate("/");
        signout();
        navigate("/");
      } else {
        alert("You are the only manager so until other manager assgne wait");
      }
    } catch (error) {
      alert(`the error is ${error}`);
    }
  };

  return (
    <div>
      <Navbar bg="light" expand="lg">
        <Container>
          <Navbar.Brand href="#">Manager</Navbar.Brand>
          <Navbar.Toggle aria-controls="basic-navbar-nav" />
          <Navbar.Collapse id="basic-navbar-nav">
            <Nav className="me-auto">
              <Nav.Link onClick={handleShow}>Show Manager</Nav.Link>
            </Nav>
          </Navbar.Collapse>
        </Container>
      </Navbar>

      <Offcanvas show={showSidebar} onHide={handleClose}>
        <Offcanvas.Header closeButton>
          <Offcanvas.Title>Manager Details</Offcanvas.Title>
        </Offcanvas.Header>
        <Offcanvas.Body>
          <img
            src={LoginData?.photoURL}
            alt="Manager"
            style={{
              width: "200px",
              height: "200px",
              position: "cover",
              borderRadius: "50%",
            }}
          />
          <p>{LoginData?.name}</p>
          <p>{LoginData?.email}</p>
          <Button
            className="my-3 mx-1"
            variant="primary"
            onClick={() => {
              registerMove(LoginData?.uid);
            }}
          >
            Register employee
          </Button>{" "}
          {/* Call registerMove function */}
          <Button className="my-3 mx-1" variant="secondary" onClick={signout}>
            logout {LoginData?.name}{" "}
          </Button>
        </Offcanvas.Body>
      </Offcanvas>

      <Offcanvas
        show={showOffcanvas}
        onHide={handleDeleteClose}
        placement="top"
        className="d-flex align-items-center justify-content-center"
        style={{height:"40%"}}
      >
        <Offcanvas.Header closeButton>
          <Offcanvas.Title>Delete The Task</Offcanvas.Title>
        </Offcanvas.Header>
        <Offcanvas.Body className="text-center">
          <div className="d-flex flex-column align-items-center">
            <p>Are You want to delete the task </p>
            <input  className="my-3" type="text" placeholder="Enter something" />

            <Button className="bg-danger" style={{border:"none"}} onClick={handleClose}>
              Delete
            </Button>
          </div>
        </Offcanvas.Body>
      </Offcanvas>

      <Container className="mt-3">
        <Table striped bordered hover>
          <thead>
            <tr>
              <th>Name</th>
              <th>ID</th>
              <th>show Submitted Task</th>
              <th>Show Asigned Tasks</th>
              <th>Assign Task</th>
              <th>Logout</th>
            </tr>
          </thead>

          <tbody>
            {employees.map((employee, index) =>
              employee.manager === LoginData?.name ? (
                <tr key={index}>
                  <td>{employee.name}</td>
                  <td>{index + 1}</td>
                  <td>
                    <Button
                      variant="primary"
                      onClick={() => {
                        navigate(`/manager/showdetail/${employee.uid}`);
                        alert(employee.uid);
                      }}
                    >
                      show Submitted Task
                    </Button>
                  </td>
                  <td>
                    <Button variant="danger" onClick={()=>{handleAsignedTasks(employee.uid)}}>
                     Show Asigned Tasks
                    </Button>
                  </td>
                  <td>
                    <Button
                      variant="success"
                      onClick={() => {
                        AssignTask(employee.uid);
                      }}
                    >
                      Assign Task
                    </Button>
                  </td>
                  <td>
                    <Button variant="warning" onClick={()=>{DeleteEmployee(employee.uid)}}>Delete employee</Button>
                  </td>
                </tr>
              ) : null
            )}
          </tbody>
        </Table>
      </Container>
    </div>
  );
}

export default Manager;
