import { useQuery } from "@tanstack/react-query";
import { axiosInstance, getToken } from "./api";
import { Patient, PatientsColumn } from "../schemas/patient-interfaces";

export function useFetchPatients() {
  return useQuery<Patient[]>({
    queryKey: ["patients"],
    queryFn: async (): Promise<Patient[]> => {
      return (await axiosInstance.post<PatientsColumn>("/patients")).data
        .patients;
    },
    initialData: [],
  });
}
