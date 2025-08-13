import mongoose from "mongoose";

export const connectDB = async () => {
  try {
    await mongoose.connect(process.env.MONGO_URI);
    console.log("MONGO DB CONNECTED");
  } catch (error) {
    console.error("DB NOT CONNECTED");
    process.exit(1);
  }
};
