import React, { useState } from 'react';
import { Form, Button, Container, Row, Col } from 'react-bootstrap';
import { signInWithEmailAndPassword } from 'firebase/auth';
import { collection, query, where, getDocs } from 'firebase/firestore';
import { db } from '../config/firebase';
import { authenticate } from '../config/firebase';
import { useNavigate } from 'react-router-dom';
import { useLogin } from '../context/LoginContext';

const LoginForm = () => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const navigate = useNavigate()
  const { setLoginData } = useLogin();

  const handleSubmit = async (e) => {
    e.preventDefault();

    await signInWithEmailAndPassword(authenticate, email, password)
    .then((userCredential)=>{
      const user = userCredential.user;
      console.log(user.email)
      console.log(user.password)

      const q = query(collection(db, 'employee'), where('email', '==', user.email));

      getDocs(q).then((querySnapshot)=>{
          querySnapshot.forEach((doc) => {
            
            console.log(doc.data())
              const userData = doc.data();

              
              if (userData && userData.position === 'manager') {
                  setLoginData(userData);
                  localStorage.setItem('loginData', JSON.stringify(userData));
                  navigate(`/manager/`)
              } else {
                  console.log('Redirecting to employee page');
                  navigate('/employee')
              }
          });

      }).catch((error)=>{
          console.log(error);
          alert(`the database error`);
      });
    }).catch((error)=>{
      console.log(error)
      alert("the login error")
    })
  };

  return (
    <Container className="d-flex justify-content-center align-items-center" style={{ minHeight: '100vh', width: "500px" }}>
      <Row>
        <Col xs={12} md={6}>
          <Form style={{ width: "500px" }} onSubmit={handleSubmit} >
            <Form.Group controlId="formBasicEmail">
              <Form.Label>Email address</Form.Label>
              <Form.Control
                type="email"
                placeholder="Enter email"
                value={email}
                onChange={(e) => setEmail(e.target.value)}
                className='my-4'
              />
              <Form.Text className="text-muted">
                We'll never share your email with anyone else.
              </Form.Text>
            </Form.Group>

            <Form.Group controlId="formBasicPassword">
              <Form.Label>Password</Form.Label>
              <Form.Control
                type="password"
                placeholder="Password"
                value={password}
                onChange={(e) => setPassword(e.target.value)}
                className='my-4'

              />
            </Form.Group>

            <Button variant="primary" type="submit">
              Login
            </Button>
          </Form>
        </Col>
      </Row>
    </Container>
  );
};

export default LoginForm;
