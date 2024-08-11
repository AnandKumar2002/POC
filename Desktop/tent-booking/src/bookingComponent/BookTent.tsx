import React, { useState } from "react";
import {
    Grid,
    Card,
    CardContent,
    Typography,
    TextField,
    Box,
    IconButton,
    Button,
    Divider,
    CardActions,
} from "@mui/material";
import AddIcon from "@mui/icons-material/Add";
import RemoveIcon from "@mui/icons-material/Remove";
import { useNavigate } from "react-router-dom";
import { useTentContext } from '../store/Store';

interface Accommodation {
    id: string;
    name: string;
    type: string;
    maxPersons: number;
    pricePerNight: number;
    sleepingBagsIncluded: boolean;
    tentsAvailable: number;
}

interface BookingSummary {
    check_in_date: string;
    check_out_date: string;
    quadHouse: number;
    quadHousePrice: number;
    hexaHouse: number;
    hexaHousePrice: number;
    max_person: number;
    total_fee: number;
}

const accommodationData: Accommodation[] = [
    {
        id: "quadhouse",
        name: "QuadHouse",
        type: "Tent",
        maxPersons: 4,
        pricePerNight: 2000,
        sleepingBagsIncluded: true,
        tentsAvailable: 5,
    },
    {
        id: "hexahouse",
        name: "HexaHouse",
        type: "Tent",
        maxPersons: 6,
        pricePerNight: 3000,
        sleepingBagsIncluded: true,
        tentsAvailable: 10,
    },
];

const BookTent: React.FC = () => {
    const [checkInDate, setCheckInDate] = useState<string>("");
    const [checkOutDate, setCheckOutDate] = useState<string>("");
    const [numTents, setNumTents] = useState<{ [key: string]: number }>({});
    const [showCards, setShowCards] = useState<boolean>(false);
    const [hoveredCard, setHoveredCard] = useState<string | null>(null);
    const navigate = useNavigate();

    const { setBookingSummary } = useTentContext();


    const handleNumTentsChange = (id: string, value: number) => {
        setNumTents((prev) => ({ ...prev, [id]: value }));
    };

    const handleTentCountChange = (id: string, delta: number) => {
        const accommodation = accommodationData.find((item) => item.id === id);
        if (!accommodation) return;
        const maxTents = Math.min(
            accommodation.tentsAvailable,
            (numTents[id] || 0) + delta
        );
        setNumTents((prev) => ({
            ...prev,
            [id]: Math.max(0, maxTents),
        }));
    };

    const handleCancelBooking = () => {
        setCheckInDate("");
        setCheckOutDate("");
        setNumTents({});
        setShowCards(false);
    };

    const calculateTotalPrice = () => {
        return accommodationData.reduce((total, accommodation) => {
            const tentCount = numTents[accommodation.id] || 0;
            return total + tentCount * accommodation.pricePerNight;
        }, 0);
    };

    const handleCheckAvailability = () => {
        if (checkInDate && checkOutDate) {
            setShowCards(true);
        }
    };

    const handleConfirmBooking = () => {
        const checkIn = checkInDate;
        const checkOut = checkOutDate;
        const totalFee = calculateTotalPrice();
        const maxPerson = Object.values(numTents).reduce((sum, count, index) => {
            return sum + count * accommodationData[index].maxPersons;
        }, 0);

        const summary: BookingSummary = {
            check_in_date: checkIn,
            check_out_date: checkOut,
            quadHouse: numTents["quadhouse"] || 0,
            quadHousePrice: 2000,
            hexaHouse: numTents["hexahouse"] || 0,
            hexaHousePrice: 3000,
            max_person: maxPerson,
            total_fee: totalFee,
        };

        console.log(summary);
        setBookingSummary(summary);
        navigate('./tent-form');
    };

    return (
        <Box textAlign="center" marginTop={4}>
            <Grid
                container
                spacing={2}
                justifyContent="center"
                alignItems="center"
                marginBottom={3}
            >
                <Grid item xs={12} md={3}>
                    <TextField
                        fullWidth
                        label="Check-in Date"
                        type="date"
                        value={checkInDate}
                        onChange={(e) => setCheckInDate(e.target.value)}
                        InputLabelProps={{ shrink: true }}
                        inputProps={{ min: "2024-08-22", max: "2024-09-11" }}
                    />
                </Grid>
                <Grid item xs={12} md={3}>
                    <TextField
                        fullWidth
                        label="Check-out Date"
                        type="date"
                        value={checkOutDate}
                        onChange={(e) => setCheckOutDate(e.target.value)}
                        InputLabelProps={{ shrink: true }}
                        inputProps={{ min: checkInDate || "2024-08-22", max: "2024-09-11" }}
                    />
                </Grid>
                <Grid item xs={12} md={3}>
                    <Button
                        fullWidth
                        variant="contained"
                        color="primary"
                        onClick={handleCheckAvailability}
                        style={{ height: "56px" }}
                    >
                        Check Availability
                    </Button>
                </Grid>
            </Grid>

            {showCards && (
                <Grid container spacing={2} justifyContent="center">
                    {accommodationData.map((accommodation) => (
                        <Grid item xs={12} md={6} key={accommodation.id}>
                            <Card
                                style={{
                                    minHeight: 350,
                                    borderRadius: "12px",
                                    boxShadow:
                                        hoveredCard === accommodation.id
                                            ? "0px 8px 16px rgba(0, 0, 0, 0.2)"
                                            : "0px 4px 8px rgba(0, 0, 0, 0.1)",
                                    transition: "transform 0.3s",
                                    transform:
                                        hoveredCard === accommodation.id
                                            ? "scale(1.05)"
                                            : "scale(1)",
                                }}
                                onMouseEnter={() => setHoveredCard(accommodation.id)}
                                onMouseLeave={() => setHoveredCard(null)}
                            >
                                <CardContent>
                                    <Typography
                                        variant="h4"
                                        style={{ fontSize: "2rem" }}
                                        gutterBottom
                                    >
                                        {accommodation.name}
                                    </Typography>

                                    <Grid container spacing={2} alignItems="center">
                                        <Grid item xs={12} sm={6} style={{ textAlign: "left" }}>
                                            <Typography
                                                variant="subtitle1"
                                                style={{ fontSize: "1.2rem" }}
                                            >
                                                Type - {accommodation.type}
                                            </Typography>
                                            <Typography
                                                variant="body2"
                                                style={{ fontSize: "1.1rem" }}
                                            >
                                                Max {accommodation.maxPersons} persons
                                            </Typography>
                                            <Typography
                                                variant="body2"
                                                style={{
                                                    color: accommodation.sleepingBagsIncluded
                                                        ? "green"
                                                        : "inherit",
                                                    fontSize: "1.1rem",
                                                }}
                                            >
                                                {accommodation.sleepingBagsIncluded
                                                    ? "Sleeping bags included"
                                                    : "No sleeping bags included"}
                                            </Typography>
                                            <Typography
                                                variant="body2"
                                                style={{ color: "red", fontSize: "1.1rem" }}
                                            >
                                                {accommodation.tentsAvailable} tents available
                                            </Typography>
                                        </Grid>

                                        <Grid item xs={12} sm={6} style={{ textAlign: "right" }}>
                                            <Typography
                                                variant="body2"
                                                style={{ fontSize: "1.1rem" }}
                                            >
                                                Check-in date
                                            </Typography>
                                            <Typography
                                                variant="body1"
                                                style={{ fontSize: "1.2rem" }}
                                            >
                                                {checkInDate}
                                            </Typography>

                                            <Typography
                                                variant="body2"
                                                style={{ fontSize: "1.1rem" }}
                                            >
                                                Check-out date
                                            </Typography>
                                            <Typography
                                                variant="body1"
                                                style={{ fontSize: "1.2rem" }}
                                            >
                                                {checkOutDate}
                                            </Typography>

                                            <Typography
                                                variant="body2"
                                                style={{ fontSize: "1.1rem" }}
                                            >
                                                For{" "}
                                                {Math.max(
                                                    1,
                                                    (new Date(checkOutDate).getTime() -
                                                        new Date(checkInDate).getTime()) /
                                                    (1000 * 3600 * 24)
                                                )}{" "}
                                                nights
                                            </Typography>

                                            <Typography
                                                variant="h6"
                                                color="secondary"
                                                style={{ fontSize: "1.3rem" }}
                                            >
                                                Price: ₹
                                                {numTents[accommodation.id]
                                                    ? accommodation.pricePerNight *
                                                    numTents[accommodation.id]
                                                    : accommodation.pricePerNight}
                                            </Typography>
                                        </Grid>
                                    </Grid>

                                    <Box
                                        marginTop={2}
                                        display="flex"
                                        flexDirection="column"
                                        alignItems="center"
                                    >
                                        <Typography variant="subtitle1">
                                            Number of Tents Needed
                                        </Typography>
                                        {accommodation.tentsAvailable > 0 ? (
                                            <Box display="flex" alignItems="center">
                                                <IconButton
                                                    onClick={() =>
                                                        handleTentCountChange(accommodation.id, -1)
                                                    }
                                                    disabled={(numTents[accommodation.id] || 0) <= 0}
                                                >
                                                    <RemoveIcon />
                                                </IconButton>
                                                <Typography
                                                    variant="body1"
                                                    style={{ margin: "0 16px" }}
                                                >
                                                    {numTents[accommodation.id] || 0}
                                                </Typography>
                                                <IconButton
                                                    onClick={() =>
                                                        handleTentCountChange(accommodation.id, 1)
                                                    }
                                                    disabled={
                                                        (numTents[accommodation.id] || 0) >=
                                                        accommodation.tentsAvailable
                                                    }
                                                >
                                                    <AddIcon />
                                                </IconButton>
                                            </Box>
                                        ) : (
                                            <Typography variant="body1" style={{ margin: "0 16px" }}>
                                                N/A
                                            </Typography>
                                        )}
                                    </Box>
                                </CardContent>
                            </Card>
                        </Grid>
                    ))}
                </Grid>
            )}

            {Object.keys(numTents).length > 0 && showCards && (
                <Card
                    style={{
                        marginTop: "30px",
                        marginBottom: "30px",
                        borderRadius: "12px",
                        boxShadow: "0px 6px 12px rgba(0, 0, 0, 0.15)",
                        padding: "20px",
                        background: "linear-gradient(135deg, #ffffff 0%, #f7f7f7 100%)",
                        textAlign: "left",
                    }}
                >
                    <CardContent>
                        <Typography
                            variant="h5"
                            gutterBottom
                            style={{
                                borderBottom: "2px solid #f5f5f5",
                                paddingBottom: "10px",
                                fontWeight: "bold",
                                fontSize: "1.25rem",
                            }}
                        >
                            Booking Summary
                        </Typography>
                        <Typography variant="body1" gutterBottom>
                            <strong>Check-in Date:</strong> {checkInDate}
                        </Typography>
                        <Typography variant="body1" gutterBottom>
                            <strong>Check-out Date:</strong> {checkOutDate}
                        </Typography>
                        <Divider style={{ margin: "20px 0" }} />
                        <Typography variant="body2" gutterBottom>
                            <strong>Tent Details:</strong>
                        </Typography>
                        {accommodationData.map((accommodation) => (
                            <div
                                key={accommodation.id}
                                style={{
                                    margin: "10px 0",
                                    padding: "10px",
                                    border: "1px solid #e0e0e0",
                                    borderRadius: "8px",
                                    backgroundColor: "#fafafa",
                                }}
                            >
                                <Typography variant="body2" style={{ fontWeight: "bold" }}>
                                    {accommodation.name}
                                </Typography>
                                <Typography variant="body2">
                                    <strong>Price per Night:</strong> ₹
                                    {accommodation.pricePerNight}
                                </Typography>
                                <Typography variant="body2">
                                    <strong>Quantity:</strong> {numTents[accommodation.id] || 0}{" "}
                                    tents
                                </Typography>
                                <Typography variant="body2">
                                    <strong>Total:</strong> ₹
                                    {accommodation.pricePerNight *
                                        (numTents[accommodation.id] || 0)}
                                </Typography>
                            </div>
                        ))}
                        <Divider style={{ margin: "20px 0" }} />
                        <Typography
                            variant="h6"
                            color="secondary"
                            style={{ fontWeight: "bold" }}
                        >
                            Total Price: ₹{calculateTotalPrice()}
                        </Typography>
                    </CardContent>
                    <CardActions
                        style={{ justifyContent: "space-between", padding: "16px" }}
                    >
                        <Button
                            variant="outlined"
                            color="secondary"
                            onClick={handleCancelBooking}
                            style={{ marginRight: "auto" }}
                        >
                            Cancel Booking
                        </Button>
                        <Button variant="contained" color="primary" onClick={handleConfirmBooking}>
                            Confirm Booking
                        </Button>
                    </CardActions>
                </Card>
            )}
        </Box>
    );
};

export default BookTent;