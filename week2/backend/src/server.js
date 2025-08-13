import express from "express";
import dotenv from "dotenv";

import nodesRouter from "./routes/nodeRoutes.js";
import { connectDB } from "./config/db.js";

const app = express();
dotenv.config({ path: ".env" });

connectDB();

app.use("/api/note", nodesRouter);

app.get("/", (req, res) => {
  res.status(200).send("HelW ddd ddorld");
});

app.listen(8777, () => {
  console.log("Server is running on port 8777, \n" + "http://localhost:8777");
});
