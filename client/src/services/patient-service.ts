import { useQuery } from "@tanstack/react-query";
import { axiosInstance, getToken } from "./api";
import { PatientsColumn } from "../schemas/patient-interfaces";

export function useFetchPatients() {
  return useQuery<PatientsColumn>({
    queryKey: ["patients"],
    queryFn: async (): Promise<PatientsColumn> => {
      return (
        await axiosInstance.post<PatientsColumn>(
          "/patients",
          {},
          {
            headers: {
              Authorization: `Bearer ${getToken()}`,
            },
          }
        )
      ).data;
    },
  });
}
