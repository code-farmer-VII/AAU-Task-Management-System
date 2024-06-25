import React, { useState } from "react";
import { Form, Button, Container, Row, Col } from "react-bootstrap";
import { collection, addDoc } from "firebase/firestore";
import { storage, db } from "../config/firebase";
import { createUserWithEmailAndPassword } from "firebase/auth";
import { authenticate } from "../config/firebase";
import { ref, uploadBytesResumable, getDownloadURL } from "firebase/storage";
import { useNavigate, useParams } from "react-router-dom";
import { query, where, getDocs } from "firebase/firestore";


const Register = () => {
  const [employee, setEmployee] = useState(null);
  const [email, setEmail] = useState("");
  const [name, setName] = useState("");
  const [password, setPassword] = useState("");
  const [phone, setPhone] = useState("");
  const [photo, setPhoto] = useState(null);
  const [position, setPosition] = useState("employee"); 
  const [user,setUser]=useState("")
  const {id}=useParams();
  const [per, setPer] = useState(null);
  const navigate = useNavigate();

  const handleRegister = async (e) => {
    e.preventDefault();

    try {
      if (photo) {
        const storageRef = ref(storage, photo.name);
        const uploadTask = uploadBytesResumable(storageRef, photo);

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
               // setPhotoURL(downloadURL);  Update photoURL state with the downloadURL
                // After photo is uploaded and URL is obtained, proceed to store data in Firestore
                addUserToFirestore(downloadURL);
              })
              .catch((error) => {
                console.error("Error getting download URL: ", error);
              });
          }
        );
      } else {
        // If no photo is uploaded, directly add user data to Firestore
        addUserToFirestore("");
      }
    } catch (error) {
      console.error("Error registering user: ", error);
    }
  };

  const addUserToFirestore = async (downloadURL) => {
    try {

      try{
        const myCollection = collection(db, "employee");
        const myQuery = query(myCollection, where("uid", "==",id));
        const managerSnapshot = await getDocs(myQuery);
        
        if (!managerSnapshot.empty) {
          managerSnapshot.forEach((doc) => {
            setEmployee(doc.data());
          });
        } else {
          console.log("No matching documents");
        }
      }catch(error){
           console.log(`be id ${error}`)
      }
      
      
      // Create user with email and password
        try {
          const userCredential = await createUserWithEmailAndPassword(
            authenticate,
            email,
            password
          );
           setUser(userCredential.user)
        } catch (error) {
          console.log(` be aut ${error}`)
        }

      // Store data in Firestore

try {
  const docRef = await addDoc(collection(db, "employee"), {
    manager:employee.name,
    email,
    name,
    password,
    phone,
    photoURL: downloadURL, // Use the downloadURL provided here
    position,
    uid: user.uid,
  });

  console.log("Document written with ID: ", docRef.id);

  // Reset form fields after successful registration
  setEmail("");
  setName("");
  setPassword("");
  setPhone("");
  setPhoto(null);
  navigate("/manager");

} catch (error) {
  console.log(`this is name menamen`)
}

    } catch (error) {
      console.error("Error registering user: ", error);
    }
  };

  return (
    <Container>
      <Row className="justify-content-md-center">
        <Col xs={12} md={6}>
          <div>
            <h2 className="text-center mb-4">Register</h2>
            <Form onSubmit={handleRegister}>
              <Form.Group className="mb-3" controlId="formBasicName">
                <Form.Label>Name</Form.Label>
                <Form.Control
                  type="text"
                  placeholder="Enter name"
                  value={name}
                  onChange={(e) => setName(e.target.value)}
                />
              </Form.Group>

              <Form.Group className="mb-3" controlId="formBasicEmail">
                <Form.Label>Email address</Form.Label>
                <Form.Control
                  type="email"
                  placeholder="Enter email"
                  value={email}
                  onChange={(e) => setEmail(e.target.value)}
                />
              </Form.Group>

              <Form.Group className="mb-3" controlId="formBasicPassword">
                <Form.Label>Password</Form.Label>
                <Form.Control
                  type="password"
                  placeholder="Password"
                  value={password}
                  onChange={(e) => setPassword(e.target.value)}
                />
              </Form.Group>

              <Form.Group className="mb-3" controlId="formBasicPhone">
                <Form.Label>Phone Number</Form.Label>
                <Form.Control
                  type="tel"
                  placeholder="Enter phone number"
                  value={phone}
                  onChange={(e) => setPhone(e.target.value)}
                />
              </Form.Group>

              <Form.Group className="mb-3" controlId="formBasicPosition">
                <Form.Label>Position</Form.Label>
                <Form.Select
                  value={position}
                  onChange={(e) => setPosition(e.target.value)}
                >
                  <option value="employee">Employee</option>
                  <option value="manager">Manager</option>
                </Form.Select>
              </Form.Group>

              <Form.Group controlId="formFile" className="mb-3">
                <Form.Label>Photo</Form.Label>
                <Form.Control
                  type="file"
                  onChange={(e) => setPhoto(e.target.files[0])}
                />
              </Form.Group>

              <Button
                disabled={per !== null && per < 100}
                variant="primary"
                type="submit"
                className="w-100"
              >
                Register
              </Button>
            </Form>
          </div>
        </Col>
      </Row>
    </Container>
  );
};

export default Register;
