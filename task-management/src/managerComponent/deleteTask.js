import { db, storage } from "../config/firebase";
import { collection, query, where, getDocs, deleteDoc } from "firebase/firestore";
import { ref, deleteObject } from "firebase/storage";

export const DeleteTask = async (employeeName) => {
  try {
    const docId = employeeName;
    alert(`thisw ${docId}`)

    // Query to get the specific tasks based on the employee name
    const taskQuery = query(collection(db, 'assignTasks'), where('emplyeeName', '==', docId));

    // Get the documents reference
    const taskSnapshot = await getDocs(taskQuery);

    if (!taskSnapshot.empty) {
      // Iterate through each task document and delete it
      for (const taskDoc of taskSnapshot.docs) {
         const fileURL = taskDoc.data().fileURL; // Access fileURL from the document data

         if (fileURL) {
           const fileRef = ref(storage, fileURL);
           await deleteObject(fileRef); // Wait for file deletion to complete
         }

        await deleteDoc(taskDoc.ref); // Wait for document deletion to complete
      }
      console.log("All matching task documents deleted successfully");
    } else {
      console.log("No matching task documents found");
    }
  } catch (error) {
    console.error("An error occurred while deleting tasks:", error.message);
    throw error; // Re-throw the error to handle it at a higher level if necessary
  }
}
