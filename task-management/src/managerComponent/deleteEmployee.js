import { storage, db, authenticate } from "../config/firebase";
import {deleteDoc,doc, collection, query, where, getDocs} from "firebase/firestore";
import { deleteUser } from 'firebase/auth'; // Import getAuth
import { ref, deleteObject } from "firebase/storage";

export const DeleteEmployee = async (uid) => {
  
        alert(uid)
        // Step 1: Retrieve employee data by uid

        const myCollection = collection(db, "employee");
        const myQuery = query(myCollection, where('uid', '==', uid));
        const querySnapshot = await getDocs(myQuery);
        const employeeData = querySnapshot.docs.map((doc) => ({
            id: doc.id,
            ...doc.data(),
        }));

        const employee = employeeData[0]; // Assuming there's only one employee with given uid

        // Step 2: Delete file from Firebase storage

         const photoURL = employee.photoURL;

         if (photoURL) {
             const fileRef = ref(storage,photoURL);

              deleteObject(fileRef)
         }

        
        try {

        // Step 3: Delete employee from authentication list

         //const empUId = employee.uid;
        // if (empUId) {
            // await deleteUser(authenticate, empUId); // Call deleteUser with auth instance
       //  }

        // Step 4: Delete employee from employee collection
        const docId = employee.id

        const docRef = doc(db, "employee", docId)
        deleteDoc(docRef).then(()=>{
            console.log("the data is deleted collection")
        }).catch(()=>{
            console.log("the documment is not deleted")
        })


        console.log("Employee deleted successfully");
    } catch (error) {
        console.error("the error is delete auth and collection", error);
        alert(error);
    }


};
