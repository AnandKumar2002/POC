import React, { createContext, useState, useContext, ReactNode, useEffect } from "react";
import { TentContextProps, OtpResponseData, BookingSummary, TentData } from "./types";
import { PrimaryTraveler, AdditionalTravelers } from "../formComponent/types";
import axios from "axios";

const TentContext = createContext<TentContextProps | undefined>(undefined);

export const TentProvider: React.FC<{ children: ReactNode }> = ({ children }) => {
    const baseUrl = "https://manimahesh.netgen.work/api";
    const [apiData, setApiData] = useState<TentData[]>([]);
    const [bookingSummary, setBookingSummary] = useState<BookingSummary | null>(null);        
    const [bookingId, setBookingId] = useState<number | null>(null);
    const [otpResponseData, setOtpResponseData] = useState<OtpResponseData | null>(null);
    const [additionalTravelersCount, setAdditionalTravelersCount] = useState<number>(0);
    const [travelers, setTravelers] = useState<AdditionalTravelers[]>([]);
    const [tents, setTents] = useState<{ tent_type_id: number; quantity: number }[]>([]);

    useEffect(() => {
        if (bookingSummary) {
            const fetchApiData = async () => {
                try {
                    const response = await axios.get(`${baseUrl}/tent/check-availability`, {
                        params: {
                            check_in_date: bookingSummary.check_in_date,
                            check_out_date: bookingSummary.check_out_date,
                        }
                    });
                    const data: TentData[] = response.data;
                    setApiData(data);
                    console.log(data);
                    
                } catch (error) {
                    console.log("Failed to fetch API data", error);
                }
            };
            fetchApiData();
        }
    }, [bookingSummary]);

    const [primaryTraveler, setPrimaryTraveler] = useState<PrimaryTraveler>({
        yatra_application_number: "",
        name: "Anand",
        age: 21,
        gender: "",
        email: "anand@gmail.com",
        mobile: "9955664455",
        id_type: "",
        id_number: "1234",
        address: "asdfghjkl",
        total_people: additionalTravelersCount + 1,
        check_in_date: "2024-08-23",
        check_out_date: "2024-08-24",
        quadHouse: 0,
        quadHousePrice: 0,
        hexaHouse: 0,
        hexaHousePrice: 0,
        total_fee: 0,
        max_person: 0,
        tents: [
            {
                "tent_type_id": 1,
                "quantity": 2
            },
            {
                "tent_type_id": 2,
                "quantity": 2
            }    
        ],
    });

    useEffect(() => {
        if (bookingSummary) {
            setPrimaryTraveler(prev => ({
                ...prev,
                check_in_date: bookingSummary.check_in_date,
                check_out_date: bookingSummary.check_out_date,
                quadHouse: bookingSummary.quadHouse,
                quadHousePrice: bookingSummary.quadHousePrice,
                hexaHouse: bookingSummary.hexaHouse,
                hexaHousePrice: bookingSummary.hexaHousePrice,
                total_fee: bookingSummary.total_fee,
                max_person: bookingSummary.max_person,
                total_people: additionalTravelersCount + 1,
                tents
            }));
        }
    }, [bookingSummary, additionalTravelersCount]);

    return (
        <TentContext.Provider value={{
            primaryTraveler,
            travelers,
            setTravelers,
            setPrimaryTraveler,
            additionalTravelersCount,
            setAdditionalTravelersCount,
            bookingId,
            setBookingId,
            otpResponseData,
            setOtpResponseData,
            total_people: primaryTraveler.total_people,
            baseUrl,
            bookingSummary,
            setBookingSummary,
            max_person: bookingSummary?.max_person ?? 0,
            apiData,
        }}>
            {children}
        </TentContext.Provider>
    );
};

// Custom hook to use the context
export const useTentContext = (): TentContextProps => {
    const context = useContext(TentContext);
    if (!context) {
        throw new Error("useTentContext must be used within a TentProvider");
    }
    return context;
};
