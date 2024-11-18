import RegistrationForm from "../components/registration-form";
import BoxReveal from "../components/ui/box-reveal";
import GridPattern from "../components/ui/grid-pattern";

function Register() {
  return (
    <main className="grid place-items-center w-full h-screen">
      <GridPattern className="z-[-1]" />
      <BoxReveal boxColor="#16a34a" duration={0.3}>
        <RegistrationForm />
      </BoxReveal>
    </main>
  );
}

export default Register;
