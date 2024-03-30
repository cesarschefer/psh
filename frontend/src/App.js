import * as React from 'react';
import CssBaseline from "@mui/material/CssBaseline";
import Navbar from "./components/Navbar";
import { ThemeProvider, createTheme } from '@mui/material/styles';
import Datatable from "./components/Datatable";

const theme = createTheme({
    palette: {
        background:{
            default: '#a8a8a8',
        },
        primary: {
            main: '#4147b2',
        },
    }
})

export default function App() {
  return (
      <ThemeProvider theme={theme}>
          <CssBaseline />
          <Navbar/>
          <Datatable/>
      </ThemeProvider>

  );
}