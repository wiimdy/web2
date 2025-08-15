import mongoose, { mongo } from "mongoose";

const noteSchema = mongoose.Schema(
  {
    title: {
      type: String,
      requried: true,
    },
    content: {
      type: String,
      requried: true,
    },
  },
  { timestamp: true }
);

const Note = mongoose.model("Note", noteSchema);

export default Note;
