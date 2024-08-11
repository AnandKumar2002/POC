import React from 'react';
import { Typography, Grid, Paper, TextField } from "@mui/material";
import { useTentContext } from '../store/Store';

const BookingDetails: React.FC = () => {
    const { bookingSummary } = useTentContext();

    if (!bookingSummary) {
        return <Typography variant="body1">No booking details available</Typography>;
    }

    const { check_in_date, check_out_date, quadHouse, quadHousePrice, hexaHouse, hexaHousePrice, max_person, total_fee } = bookingSummary;

    // Calculate number of nights
    const checkIn = new Date(check_in_date);
    const checkOut = new Date(check_out_date);
    const numberOfNights = Math.ceil((checkOut.getTime() - checkIn.getTime()) / (1000 * 3600 * 24));

    // Calculate cost for each type of tent
    const quadTentCost = quadHouse * numberOfNights * quadHousePrice;
    const hexaTentCost = hexaHouse * numberOfNights * hexaHousePrice;

    return (
        <Paper
            elevation={3}
            sx={{ padding: "16px", margin: "16px", borderRadius: "8px" }}
        >
            <Grid container justifyContent="center">
                <Grid item xs={12}>
                    <Typography
                        variant="h5"
                        sx={{
                            textAlign: "center",
                            fontWeight: "bold",
                            textTransform: "uppercase",
                            background: "#a81f10",
                            color: "#fff",
                            padding: 2,
                            borderRadius: 2,
                        }}
                    >
                        Booking Details
                    </Typography>
                    <Grid container mt={1} spacing={2}>
                        <Grid item xs={12} sm={6}>
                            <TextField
                                fullWidth
                                label="Check-In Date"
                                value={check_in_date}
                                InputProps={{ readOnly: true }}
                                variant="outlined"
                                margin="normal"
                                disabled
                            />
                        </Grid>
                        <Grid item xs={12} sm={6}>
                            <TextField
                                fullWidth
                                label="Check-Out Date"
                                value={check_out_date}
                                InputProps={{ readOnly: true }}
                                variant="outlined"
                                margin="normal"
                                disabled
                            />
                        </Grid>
                        <Grid item xs={12} sm={6}>
                            <TextField
                                fullWidth
                                label="Quad Tent"
                                value={`${quadHouse} X $${quadHousePrice} X ${numberOfNights} Nights = $${quadTentCost}`}
                                InputProps={{ readOnly: true }}
                                variant="outlined"
                                margin="normal"
                                disabled
                            />
                        </Grid>
                        <Grid item xs={12} sm={6}>
                            <TextField
                                fullWidth
                                label="Hexa Tent"
                                value={`${hexaHouse} X $${hexaHousePrice} X ${numberOfNights} Nights = $${hexaTentCost}`}
                                InputProps={{ readOnly: true }}
                                variant="outlined"
                                margin="normal"
                                disabled
                            />
                        </Grid>
                        <Grid item xs={12} sm={6}>
                            <TextField
                                fullWidth
                                label="Max Persons"
                                value={max_person}
                                InputProps={{ readOnly: true }}
                                variant="outlined"
                                margin="normal"
                                disabled
                            />
                        </Grid>
                        <Grid item xs={12} sm={6}>
                            <TextField
                                fullWidth
                                label="Total Fee"
                                value={`$${total_fee}`}
                                InputProps={{ readOnly: true }}
                                variant="outlined"
                                margin="normal"
                                disabled
                            />
                        </Grid>
                    </Grid>
                </Grid>
            </Grid>
        </Paper>
    );
};

export default BookingDetails;
