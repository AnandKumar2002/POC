import React from 'react';
import { Dialog, DialogContent, Typography, Button, Box } from '@mui/material';
import image from '../assets/tent_Image.jpg';

interface WelcomeTentModalProps {
    open: boolean;
    onClose: () => void;
}

const WelcomeTentModal: React.FC<WelcomeTentModalProps> = ({ open, onClose }) => {

    return (
        <Dialog
            open={open}
            onClose={onClose}
            fullWidth
            maxWidth="md"
            PaperProps={{
                style: {
                    backgroundColor: '#f5f5f5',
                    padding: 0,
                },
            }}
        >
            <DialogContent>
                <Box
                    sx={{
                        display: 'flex',
                        flexDirection: 'column',
                        alignItems: 'center',
                        justifyContent: 'center',
                        height: '70vh',
                        textAlign: 'center',
                        backgroundImage: `url(${image})`,
                        backgroundSize: 'cover',
                        backgroundPosition: 'center',
                        color: 'white',
                        padding: 4,
                        borderRadius: '8px',
                        boxShadow: 3,
                        border: '1px solid rgba(255, 255, 255, 0.3)',
                    }}
                >
                    <Typography
                        variant="h4"
                        gutterBottom
                        sx={{
                            fontWeight: 'bold',
                            fontSize: { xs: '2rem', sm: '2rem', md: '2.5rem' },
                            textShadow: '2px 2px 4px rgba(0, 0, 0, 0.5)',
                        }}
                    >
                        Welcome to Tent Camping
                    </Typography>
                    <Typography
                        variant="h6"
                        gutterBottom
                        sx={{
                            color: "#b22515",
                            fontWeight: 'bold',
                            fontSize: { xs: '1.2rem', sm: '1.5rem', md: '1.8rem' },
                            textShadow: '1px 1px 2px rgba(0, 0, 0, 0.5)',
                        }}
                    >
                        Open Date
                    </Typography>
                    <Typography
                        variant="h6"
                        gutterBottom
                        sx={{
                            fontWeight: 'bold',
                            fontSize: { xs: '1.2rem', sm: '1.5rem', md: '1.8rem' },
                            textShadow: '1px 1px 2px rgba(0, 0, 0, 0.5)',
                        }}
                    >
                        22nd August to 14th September
                    </Typography>
                    <Typography
                        variant="body1"
                        paragraph
                        sx={{
                            fontWeight: 'bold',
                            fontSize: { xs: '1rem', sm: '1.2rem', md: '1.5rem' },
                            textShadow: '1px 1px 2px rgba(0, 0, 0, 0.5)',
                        }}
                    >
                        Adventure Begins!
                    </Typography>
                    <Button
                        variant="contained"
                        onClick={onClose}
                        sx={{
                            backgroundColor: '#b22515',
                            '&:hover': {
                                backgroundColor: '#e56051',
                            },
                            fontWeight: 'bold',
                            fontSize: { xs: '0.9rem', sm: '1rem', md: '1.2rem' },
                            padding: { xs: '8px 16px', sm: '10px 20px', md: '12px 24px' },
                        }}
                    >
                        Start
                    </Button>
                </Box>
            </DialogContent>
        </Dialog>
    );
};

export default WelcomeTentModal;
