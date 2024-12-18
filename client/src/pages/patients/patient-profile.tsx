import { Label } from "../../components/ui/label";
import {
  Select,
  SelectTrigger,
  SelectValue,
  SelectContent,
  SelectItem,
} from "../../components/ui/select";
import { Button } from "../../components/ui/button";
import {
  CardHeader,
  CardTitle,
  CardContent,
  CardDescription,
  CardFooter,
} from "../../components/ui/card";
import { Input } from "../../components/ui/input";
import { useForm } from "react-hook-form";
import { Patient, patientSchema } from "../../schemas/patient-interfaces";
import { zodResolver } from "@hookform/resolvers/zod";
import {
  useFetchPatientById,
  useUpdatePatient,
} from "../../services/patient-service";
import Error from "../../components/ui/error";
import { Avatar, AvatarFallback } from "../../components/ui/avatar";
import { AvatarImage } from "@radix-ui/react-avatar";
import { useParams } from "react-router-dom";
import { usePatientStore } from "../../store/patients-store";
import useMultiFormStore from "../../store/multiform-store";
import { useEffect, useLayoutEffect } from "react";

function PatientProfile() {
  const { patientId } = useParams();

  const {
    register,
    handleSubmit,
    formState: { errors },
  } = useForm<Patient>({
    resolver: zodResolver(patientSchema),
  });

  const { data, setData } = useMultiFormStore();

  const { mutate } = useUpdatePatient();
  const { data: patient } = useFetchPatientById(patientId!);

  useEffect(() => {
    setData(patient);
  }, []);

  return (
    <main>
      <form
        onSubmit={handleSubmit((data) => mutate(data))}
        className="grid w-3/6"
      >
        <CardHeader className="grid">
          <CardTitle>Patient Profile Details</CardTitle>
        </CardHeader>
        <CardContent>
          <section className="grid gap-4">
            <CardDescription></CardDescription>
            <div>
              <Label>First Name</Label>
              <Input
                value={data.firstName}
                type="text"
                {...register("firstName")}
              />
              {errors.firstName && <Error>{errors.firstName?.message}</Error>}
            </div>
            <div>
              <Label>Middle Name</Label>
              <Input
                type="text"
                value={data.middleName}
                {...register("middleName")}
              />
              {errors.middleName && <Error>{errors.middleName?.message}</Error>}
            </div>
            <div>
              <Label>Last Name</Label>
              <Input
                type="text"
                value={data.lastName}
                {...register("lastName")}
              />
              {errors.lastName && <Error>{errors.lastName?.message}</Error>}
            </div>
            <div>
              <Label>Email Address</Label>
              <Input type="text" value={data.email} {...register("email")} />
              {errors.email && <Error>{errors.email?.message}</Error>}
            </div>
            <div>
              <Label>Address</Label>
              <Input
                type="text"
                value={data.address}
                {...register("address")}
              />
              {errors.address && <Error>{errors.address?.message}</Error>}
            </div>
            <div>
              <Label>Date of Birth</Label>
              <Input
                type="date"
                value={data.birthDate}
                {...register("birthDate")}
                className="w-36"
              />
              {errors.birthDate && <Error>{errors.birthDate?.message}</Error>}
            </div>
            <div>
              <Label>Phone Number</Label>
              <Input
                type="number"
                value={data.phoneNumber}
                {...register("phoneNumber")}
              />
              {errors.phoneNumber && (
                <Error>{errors.phoneNumber?.message}</Error>
              )}
            </div>
            <div>
              <Label>Emergency Contact</Label>
              <Input
                type="number"
                value={data.emergencyContact}
                {...register("emergencyContact")}
              />
              {errors.emergencyContact && (
                <Error>{errors.emergencyContact?.message}</Error>
              )}
            </div>
            <div className="grid">
              <Label>Gender</Label>
              <Select>
                <SelectTrigger className="w-36">
                  <SelectValue placeholder={data.gender} />
                </SelectTrigger>
                <SelectContent>
                  <SelectItem value="male">Male</SelectItem>
                  <SelectItem value="female">Female</SelectItem>
                  <SelectItem value="other">Other</SelectItem>
                </SelectContent>
              </Select>
              {errors.gender && <Error>{errors.gender?.message}</Error>}
            </div>

            <CardDescription>Insurance Form Section</CardDescription>
            <div>
              <Label>Insurance Provider</Label>
              <Input
                type="text"
                value={data.insuranceProvider}
                {...register("insuranceProvider")}
              />
              {errors.insuranceProvider && (
                <Error>{errors.insuranceProvider?.message}</Error>
              )}
            </div>

            <div>
              <Label>Policy Number</Label>
              <Input
                type="number"
                value={data.policyNumber}
                {...register("policyNumber")}
              />
              {errors.policyNumber && (
                <Error>{errors.policyNumber?.message}</Error>
              )}
            </div>
          </section>

          <section>
            <Avatar>
              <AvatarImage />
              <AvatarFallback />
            </Avatar>
          </section>
        </CardContent>
        <CardFooter className="flex gap-4">
          <Button>Update</Button>
          <Button variant={"secondary"}>Cancel</Button>
        </CardFooter>
      </form>
    </main>
  );
}

export default PatientProfile;
