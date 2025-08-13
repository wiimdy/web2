import express from "express";
import { getAllnotes } from "../controllers/notesController.js";
const router = express.Router();

export default router;

router.get("/test", getAllnotes);

router.get("/add", (req, res) => {
  res.status(200).send("hello word");
});

// app.get("/", (req, res) => {
//     res.status(200).send("HelW ddd ddorld");
//   });

//   app.get(

//   app.post("/test", (req, res) => {
//     res.status(201).send({ message: "test clear" });
//   });

//mongodb+srv://user:12341234@cluster0.wjkg2jo.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0
