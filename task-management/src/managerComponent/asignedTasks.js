import React, { useState, useEffect } from "react";
import { useParams } from "react-router-dom";
import { collection, query, where, getDocs } from "firebase/firestore";
import { db } from "../config/firebase";
import { Card, Button, Row, Col, Offcanvas, Navbar, Container, Accordion } from "react-bootstrap";
import { AiOutlineEdit } from "react-icons/ai";
import { MdOutlineDelete } from "react-icons/md";
import { IoMdDownload } from "react-icons/io";
import { DeleteTask } from "./deleteTask";



const AsignedTasks = () => {
  const { id } = useParams();
  const [employee, setEmployee] = useState(null);
  const [tasks, setTasks] = useState([]);
  const [showOffcanvas, setShowOffcanvas] = useState(false);

  useEffect(() => {
    const fetchEmployee = async () => {
      try {
        const myCollection = collection(db, "employee");
        const myQuery = query(myCollection, where("uid", "==", id));
        const managerSnapshot = await getDocs(myQuery);

        if (!managerSnapshot.empty) {
          managerSnapshot.forEach((doc) => {
            setEmployee(doc.data());
          });
        } else {
          console.log("No matching documents");
        }
      } catch (error) {
        console.error("Error fetching employee:", error);
      }
    };

    const fetchAssignedTasks = async () => {
      try {
        const myCollection = collection(db, "assignTasks");
        const myQuery = query(myCollection, where('emplyeeName', '==', employee.name));
        const managerSnapshot = await getDocs(myQuery);

        const AsignedtasksData = [];
        if (!managerSnapshot.empty) {
          managerSnapshot.forEach((doc) => {
            AsignedtasksData.push(doc.data());
          });
          setTasks(AsignedtasksData);
        } else {
          console.log("No matching documents");
        }
      } catch (error) {
        console.error("Error fetching tasks:", error);
      }
    };

    fetchEmployee();
    fetchAssignedTasks();

  }, [id, employee]);

  const handleOffcanvas = () => setShowOffcanvas(!showOffcanvas);

  return (
    <div>
      <Navbar bg="light" expand="lg">
        <Container>
          <Navbar.Toggle aria-controls="basic-navbar-nav" />
          <Navbar.Collapse id="basic-navbar-nav">
            <Button variant="primary" onClick={handleOffcanvas}>
              Employee Details
            </Button>
          </Navbar.Collapse>
          <Navbar.Brand href="#">
            <img style={{ width: "500px", height: "100px", position: "cover" }} src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTKrlsUmu1UOH81dGG6MBHR-SpX_jbglAjhiac72UT4qyBIgiSXbrcQfnwU6a8-lpDFXg&usqp=CAU" alt="" />
          </Navbar.Brand>
        </Container>
      </Navbar>

      <Offcanvas show={showOffcanvas} onHide={handleOffcanvas}>
        <Offcanvas.Header closeButton>
          <Offcanvas.Title>Employee Details</Offcanvas.Title>
        </Offcanvas.Header>
        <Offcanvas.Body>
          {employee && (
            <div className="employee-info">
              <img style={{ width: "200px", height: "200px" }} src={employee.photoURL} alt="Employee" />
              <h2>{employee.name}</h2>
              <p>Email: {employee.email}</p>
              <p>Phone: {employee.phone}</p>
            </div>
          )}
        </Offcanvas.Body>
      </Offcanvas>

      <div className="tasks-grid">
        <Row  className="g-4">
          {tasks.map((task) => (
            <Col key={task.id} >
              <Card style={{ width: "18rem", margin: "8px" }}>
                <Card.Body>
                  <Card.Title>{task.title}</Card.Title>
                  <Card.Subtitle className="mb-2 text-muted">
                    Submitted Date: {task.submittedDate ? new Date(task.submittedDate.seconds * 1000).toLocaleString() : ""}
                  </Card.Subtitle>
                  <Accordion>
                    <Accordion.Item eventKey="0">
                      <Accordion.Header>Description</Accordion.Header>
                      <Accordion.Body>{task.description}</Accordion.Body>
                    </Accordion.Item>
                  </Accordion>
                  <div className="d-flex my-3">
                  <a className="p-2 flex-fill mr-2 bg-primary text-white" href={task.fileURL} download>
                  <IoMdDownload />
                  </a> 
                      <a  className="p-2 flex-fill mr-2 bg-secondary text-white"><AiOutlineEdit /></a>
                      <p onClick={()=>{DeleteTask(employee.name)}} className="p-2 flex-fill bg-success text-white"><MdOutlineDelete /></p>
                  </div>
                </Card.Body>
              </Card>
            </Col>
          ))}
        </Row>
      </div>
    </div>
  );
};

export default AsignedTasks;
