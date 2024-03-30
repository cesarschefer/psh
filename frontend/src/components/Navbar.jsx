import * as React from 'react';
import AppBar from '@mui/material/AppBar';
import Box from '@mui/material/Box';
import Toolbar from '@mui/material/Toolbar';
import IconButton from '@mui/material/IconButton';
import Typography from '@mui/material/Typography';
import Container from '@mui/material/Container';
import Avatar from '@mui/material/Avatar';
import {useTheme} from "@mui/material";

function Navbar() {
    const theme = useTheme();

    return (
        <AppBar position="static" sx={{ backgroundColor: 'white' }}>
            <Container maxWidth="xl">
                <Toolbar disableGutters>

                    <Box>
                        <IconButton>
                            <Avatar alt="psh logo" src="/logopsh.jpg" />
                        </IconButton>
                    </Box>

                    <Box sx={{ flexGrow: 1, display: 'flex', justifyContent: 'center' }}>
                        <Typography
                            variant="h4"
                            sx={{
                                display: { xs: 'none', sm: 'flex' },
                                fontFamily: 'monospace',
                                fontWeight: 700,
                                letterSpacing: '8px',
                                color: theme.palette.primary.main
                            }}
                        >
                            PSh-Challenge
                        </Typography>
                    </Box>
                </Toolbar>
            </Container>
        </AppBar>
    );
}
export default Navbar;