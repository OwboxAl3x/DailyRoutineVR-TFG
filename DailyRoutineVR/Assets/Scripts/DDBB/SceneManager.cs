using System.Collections;
using System;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.SceneManagement;

public class SceneManager : MonoBehaviour
{
    
    [Header("Buscar")]
    [SerializeField] private InputField numInputExistente = null;
    [SerializeField] private Text m_errorText = null;

    [Header("Actividad")] 
    [SerializeField] private Text textoActividad = null;
    [SerializeField] private Toggle checkAuditivo = null;
    [SerializeField] private Toggle checkVisual = null;
    [SerializeField] private Toggle checkDistracciones = null;
    [SerializeField] private Slider sliderMinutos = null;
    [SerializeField] private Text textoMinutos = null;

    [Header("Paneles")] 
    public GameObject panelLogin;
    public GameObject panelActividad;

    private NetworkManager m_networkManager = null;

    private String usuario;
    private String idUsuario;
    private String nomUsuario;
    private String tiempoMax;

    private void Start()
    {
        panelLogin.gameObject.SetActive(true);
        panelActividad.gameObject.SetActive(false);
    }

    private void Update()
    {
        textoMinutos.text = sliderMinutos.value.ToString() + " minutos";
    }

    private void Awake()
    {
        m_networkManager = GameObject.FindObjectOfType<NetworkManager>();
    }

    public void changePanel(GameObject panelOpen, GameObject panelClose)
    {
        panelOpen.gameObject.SetActive(!panelOpen.activeSelf);
        panelClose.gameObject.SetActive(!panelClose.activeSelf);
        
        numInputExistente.text = "";
        m_errorText.text = "";
    }

    public void iniciarActividad()
    {
        tiempoMax = sliderMinutos.value.ToString();
        
        m_networkManager.registerTest(idUsuario, "1", tiempoMax, delegate(Response response)
        {
            if (response.done == true)
            {
                PlayerPrefs.SetString("idPrueba", response.message);
                print("Prueba " + response.message + " registrada correctamente");
                    
                PlayerPrefs.SetString("idUsuario", idUsuario);
                PlayerPrefs.SetString("nomUsuario", nomUsuario);
                PlayerPrefs.SetString("Actividad", "1");
                PlayerPrefs.SetString("Distractores", checkDistracciones.isOn.ToString());
                PlayerPrefs.SetString("FeedbackAu", checkAuditivo.isOn.ToString());
                PlayerPrefs.SetString("FeedBackVi", checkVisual.isOn.ToString());
                PlayerPrefs.SetString("Minutos", sliderMinutos.value.ToString());
                UnityEngine.SceneManagement.SceneManager.LoadScene("Actividad1");
            }
        });
    }

    public void atrasMenu()
    {
        panelActividad.gameObject.SetActive(false);
        panelLogin.gameObject.SetActive(true);
    }

    public void chosseUser()
    {
        if (numInputExistente.text == "")
        {
            m_errorText.text = "Por favor, rellena número del contacto";
            return;
        }

        m_errorText.text = "Buscando...";

        m_networkManager.searchUser(numInputExistente.text, delegate(Response response)
            {
                if (response.done == true)
                {
                    usuario = response.message.Split(':')[1];
                    idUsuario = usuario.Split(',')[0];
                    nomUsuario = usuario.Split(',')[1];
                    
                    changePanel(panelActividad, panelLogin);
                    textoActividad.text = response.message;
                }
                else
                {
                    m_errorText.text = response.message;
                }
            });
    }
}
