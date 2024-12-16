import { useQuery } from "@tanstack/react-query";
import { axiosInstance, getToken } from "./api";

export function useFetchDoctors() {
  return useQuery({
    queryKey: ["doctors"],
    queryFn: async () => {
      return (
        await axiosInstance.post(
          "/doctors",
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
