import * as React from 'react';
import { DataGrid } from '@mui/x-data-grid';
import Container from '@mui/material/Container';
import Typography from "@mui/material/Typography";
import {Button, Snackbar, SnackbarContent, useTheme} from "@mui/material";
import {useEffect, useState} from "react";
import axios from "axios";


const columns = [
    { field: 'id', headerName: 'Stat ID',align: 'center', headerAlign: 'center',  minWidth: 75 },
    { field: 'uuid', headerName: 'Player ID', align: 'center' ,headerAlign: 'center', minWidth: 300  },
    { field: 'nickname', headerName: 'Nickname', align: 'center', headerAlign: 'center', minWidth: 150 },
    {
        field: 'profileImage',
        headerName: 'Profile Image',
        align: 'center',
        headerAlign: 'center',
        minWidth: 50,
        renderCell: (params) => (
            <img src={params.value} alt="Profile Image" style={{ width: 50, height: 50 }} />
        )
    },
    { field: 'creationDate', headerName: 'Creation Date', headerAlign: 'center', align: 'center', minWidth: 175 },
    {
        field: 'score',
        headerName: 'Score',
        headerAlign: 'center',
        align: 'center',
        minWidth: 50
    },
];

export default function Datatable() {
    const theme = useTheme();
    const [stats, setStats] = useState([])
    const [lastGenerated, setLastGenerated] = useState('')
    const [snackbar, setSnackbar] = useState({open: false, message: ''})

    useEffect(() => {
        const interval = setInterval(() => {
            getStats();
        }, 10000);
        return () => clearInterval(interval);

    }, [])

    const getStats = async () => {
        const url = 'http://127.0.0.1:8000/api/statistics';
        await axios.get(url)
            .then(function (response) {
                const data = response.data.data;
                const lastGenerated = response.data.last_generated;
                setStats(data);
                setLastGenerated(lastGenerated);
            })
            .catch(error => {
                handleError(error);
            });
        }

    const handleExport =  () => {
        const url = 'http://127.0.0.1:8000/api/statistics/export'
         axios.get(url)
            .then(function (response) {
                const data = response.data.data;
                const binaryData = atob(data);
                const blob = new Blob([binaryData], { type: 'application/csv' });
                const url = window.URL.createObjectURL(blob);
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', 'best_scores.csv');
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            })
            .catch(error => {
                handleError(error);
            });
    }

    const handleError = (error) => {
        const { response: { data: { message } } } = error;
        setSnackbar({ open: true, message });
    }

    const handleClose = () => {
        setSnackbar({ ...snackbar, open: false });
    }

    return (
        <Container maxWidth="xl" sx={{ padding: '20px', textAlign:"center" }} >

                    <Typography variant="h3"
                                sx= {{
                                    display: 'flex',
                                    justifyContent: 'center',
                                    marginBottom: '30px',
                                }}>
                        Top 10 best scores
                    </Typography>

                    <div style={{width: "1000px", margin:"auto", paddingBottom:"30px"}}>
                        <h2 style={{  color: theme.palette.primary.main}}>
                            Last time stats generated: {lastGenerated}
                        </h2>
                        <DataGrid
                            title="Título del DataGrid"
                            rows={stats}
                            columns={columns}
                            hideFooterPagination={true}
                            hideFooter={true}
                            sx={{
                                color: 'black',
                            }}
                        />
                    </div>

                    <Button
                        variant="contained"
                        onClick={() => handleExport()}
                        sx={{
                            backgroundColor: theme.palette.primary.main,
                        }}
                    >
                        Export to CSV
                    </Button>

                    <Snackbar
                        anchorOrigin={{ vertical: 'bottom', horizontal: 'center' }}
                        open={snackbar.open}
                        message={snackbar.message}
                        autoHideDuration={3000}
                        onClose={handleClose}
                        onClick={handleClose}
                    >
                        <SnackbarContent style={{backgroundColor:'red',color:"white"}}
                                         message={<span>{snackbar.message}</span>}
                                         onClick={handleClose}
                        />
                    </Snackbar>
        </Container>
    );
}