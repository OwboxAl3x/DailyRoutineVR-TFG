using System.Collections;
using System;
using UnityEngine;
using UnityEngine.Networking;

public class NetworkManager : MonoBehaviour
{
    private string searchURL = "http://localhost/Unity/DB/BuscarContacto.php";
    private string listURL = "http://localhost/Unity/DB/ObtenerLista.php";
    private string registerTestURL = "http://localhost/Unity/DB/RegistrarPrueba.php";
    private string registerDetailURL = "http://localhost/Unity/DB/RegistrarDetalle.php";
    private string getLastDetailURL = "http://localhost/Unity/DB/UltimoDetalle.php";
    private string finaliceURL = "http://localhost/Unity/DB/FinalizarPrueba.php";

    public void searchUser(string num, Action<Response> response)
    {
        StartCoroutine(CO_SearchUser(num, response));
    }
    
    public void registerTest(string idContacto, string actividad, string tiempoMax, Action<Response> response)
    {
        StartCoroutine(CO_RegisterTest(idContacto, actividad, tiempoMax, response));
    }
    
    public void registerDetail(string idPrueba, string tipo, string texto, Action<Response> response)
    {
        StartCoroutine(CO_RegisterDetail(idPrueba, tipo, texto, response));
    }
    
    public void getLastDetail(string idPrueba, int veces, Action<Response> response)
    {
        StartCoroutine(CO_GetLastDetail(idPrueba, veces, response));
    }
    
    public void listObjects(string actividad, Action<Response> response)
    {
        StartCoroutine(CO_ListObjetos(actividad, response));
    }
    
    public void finalizar(string objetos, string idPrueba, Action<Response> response)
    {
        StartCoroutine(CO_Finalizar(objetos, idPrueba, response));
    }

    private IEnumerator CO_SearchUser(string num, Action<Response> response)
    {
        WWWForm form = new WWWForm();
        form.AddField("num", num);
        
        UnityWebRequest uwr = UnityWebRequest.Post(searchURL, form);

        yield return uwr.SendWebRequest();

        if (uwr.isNetworkError || uwr.isHttpError)
        {
            Debug.Log(uwr.error);
        }
        else
        {
            response(JsonUtility.FromJson<Response>(uwr.downloadHandler.text));
        }
    }
    
    private IEnumerator CO_RegisterTest(string idContacto, string actividad, string tiempoMax, Action<Response> response)
    {
        WWWForm form = new WWWForm();
        form.AddField("idContacto", idContacto);
        form.AddField("actividad", actividad);
        form.AddField("tiempoMax", tiempoMax);
        
        UnityWebRequest uwr = UnityWebRequest.Post(registerTestURL, form);

        yield return uwr.SendWebRequest();

        if (uwr.isNetworkError || uwr.isHttpError)
        {
            Debug.Log(uwr.error);
        }
        else
        {
            response(JsonUtility.FromJson<Response>(uwr.downloadHandler.text));
        }
    }
    
    private IEnumerator CO_RegisterDetail(string idPrueba, string tipo, string texto, Action<Response> response)
    {
        WWWForm form = new WWWForm();
        form.AddField("idPrueba", idPrueba);
        form.AddField("tipo", tipo);
        form.AddField("texto", texto);
        
        UnityWebRequest uwr = UnityWebRequest.Post(registerDetailURL, form);

        yield return uwr.SendWebRequest();

        if (uwr.isNetworkError || uwr.isHttpError)
        {
            Debug.Log(uwr.error);
        }
        else
        {
            response(JsonUtility.FromJson<Response>(uwr.downloadHandler.text));
        }
    }
    
    private IEnumerator CO_GetLastDetail(string idPrueba, int veces, Action<Response> response)
    {
        WWWForm form = new WWWForm();
        form.AddField("idPrueba", idPrueba);
        form.AddField("veces", veces);
        
        UnityWebRequest uwr = UnityWebRequest.Post(getLastDetailURL, form);

        yield return uwr.SendWebRequest();

        if (uwr.isNetworkError || uwr.isHttpError)
        {
            Debug.Log(uwr.error);
        }
        else
        {
            response(JsonUtility.FromJson<Response>(uwr.downloadHandler.text));
        }
    }
    
    private IEnumerator CO_ListObjetos(string actividad, Action<Response> response)
    {
        WWWForm form = new WWWForm();
        form.AddField("actividad", actividad);
        
        UnityWebRequest uwr = UnityWebRequest.Post(listURL, form);

        yield return uwr.SendWebRequest();

        if (uwr.isNetworkError || uwr.isHttpError)
        {
            Debug.Log(uwr.error);
        }
        else
        {
            response(JsonUtility.FromJson<Response>(uwr.downloadHandler.text));
        }
    }
    
    private IEnumerator CO_Finalizar(string objetos, string idPrueba, Action<Response> response)
    {
        WWWForm form = new WWWForm();
        form.AddField("objetos", objetos);
        form.AddField("idPrueba", idPrueba);
        
        UnityWebRequest uwr = UnityWebRequest.Post(finaliceURL, form);

        yield return uwr.SendWebRequest();

        if (uwr.isNetworkError || uwr.isHttpError)
        {
            Debug.Log(uwr.error);
        }
        else
        {
            response(JsonUtility.FromJson<Response>(uwr.downloadHandler.text));
        }
    }
}

[Serializable]
public class Response
{
    public bool done = false;
    public string message = "";
}