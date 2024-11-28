import { useQuery } from "@tanstack/react-query";
import { getData } from "./api";

export const useGetDashboard = () => useQuery({
  queryKey: ['dashbaord'],
  queryFn: getData
})