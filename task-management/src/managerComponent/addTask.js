import { useState, useEffect } from "react";
import { useParams, useNavigate } from "react-router-dom";
import { Form, Button, Container, Row, Col, Image } from "react-bootstrap";
import { collection, query, where, getDocs, addDoc } from "firebase/firestore";
import { ref, uploadBytesResumable, getDownloadURL } from "firebase/storage";
import { db, storage } from "../config/firebase";

const TaskAdd = () => {
  const { id } = useParams();
  const [employee, setEmployee] = useState(null);
  const [title, setTitle] = useState("");
  const [description, setDescription] = useState("");
  const [file, setFile] = useState(null);
  const [per, setPer] = useState(null);
  const navigate = useNavigate();

  const fetchEmployeeData = async () => {
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

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      if (file) {
        const storageRef = ref(storage, `assignTasks/${file.name}`);
        const uploadTask = uploadBytesResumable(storageRef, file);

        uploadTask.on(
          "state_changed",
          (snapshot) => {
            const progress =
              (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
            console.log("Upload is " + progress + "% done");
            setPer(progress);
          },
          (error) => {
            console.log(error);
          },
          () => {
            getDownloadURL(uploadTask.snapshot.ref)
              .then((downloadURL) => {
                addUserToFirestore(downloadURL);
              })
              .catch((error) => {
                console.error("Error getting download URL: ", error);
              });
          }
        );
      } else {
        addUserToFirestore("");
      }
    } catch (error) {
      console.error("Error registering user: ", error);
    }
  };

  const addUserToFirestore = async (downloadURL) => {
    try {
      const docRef = await addDoc(collection(db, "assignTasks"), {
        title,
        description,
        emplyeeName:employee.name,
        submittedDate: new Date(),
        fileURL: downloadURL,
        employeeId: id,
      });
      console.log("Document written with ID: ", docRef.id);

      setTitle("");
      setDescription("");
      setFile(null);
      navigate("/manager");
    } catch (error) {
      console.error("Error adding task:", error);
    }
  };

  useEffect(() => {
    fetchEmployeeData();
  }, []);

  return (
    <Container className="mt-5">
      {employee && (
        <Row className="justify-content-center">
          <Col xs={6} className="text-center">
            <Image src={employee.photoURL} roundedCircle style={{ width: "100px", height: "100px" }} />
            <h3>{employee.name}</h3>
            <p>Email: {employee.email}</p>
            <p>Phone: {employee.phone}</p>
          </Col>
        </Row>
      )}
      <Row className="justify-content-center">
        <Col xs={6}>
          <Form onSubmit={handleSubmit}>
            <Form.Group controlId="title">
              <Form.Label>Title</Form.Label>
              <Form.Control
                type="text"
                placeholder="Enter title"
                value={title}
                onChange={(e) => setTitle(e.target.value)}
              />
            </Form.Group>
            <Form.Group controlId="description">
              <Form.Label>Description</Form.Label>
              <Form.Control
                as="textarea"
                rows={3}
                placeholder="Enter description"
                value={description}
                onChange={(e) => setDescription(e.target.value)}
              />
            </Form.Group>
            <Form.Group controlId="file">
              <Form.Label>File</Form.Label>
              <Form.Control
                type="file"
                onChange={(e) => setFile(e.target.files[0])}
              />
            </Form.Group>
            <Button
              disabled={per !== null && per < 100}
              variant="primary"
              type="submit"
            >
              Submit
            </Button>
          </Form>
        </Col>
      </Row>
    </Container>
  );
};

export default TaskAdd;
