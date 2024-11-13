import { useMsg } from "../services/queries";

function Home() {
  const { data } = useMsg();

  return <div className="text-2xl">{data?.msg}</div>;
}

export default Home;
