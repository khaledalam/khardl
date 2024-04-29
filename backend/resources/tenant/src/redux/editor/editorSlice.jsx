import { createSlice } from "@reduxjs/toolkit";

let nextTemplateId = 0;

const editorSlice = createSlice({
  name: "editor",
  initialState: {
    templates: {},
  },
  reducers: {
    addTemplate: (state, action) => {
      const id = nextTemplateId++;
      state.templates[id] = action.payload;
    },
    updateTemplate: (state, action) => {
      const { id, content } = action.payload;
      state.templates[id] = content;
    },
  },
});

export const { addTemplate, updateTemplate } = editorSlice.actions;
export default editorSlice.reducer;
