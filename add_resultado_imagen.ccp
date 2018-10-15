<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Datos" name="resultados" dataSource="resultados" errorSummator="Error" wizardCaption="Agregar/Editar Resultados " wizardTheme="Inline" wizardThemeType="File" wizardFormMethod="post" returnPage="closeandrefresh.ccp" PathID="resultados">
			<Components>
				<TextBox id="12" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="valor" fieldSource="valor" required="False" caption="Valor" wizardCaption="Valor" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="resultadosvalor">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<FileUpload id="28" fieldSourceType="DBColumn" allowedFileMasks="*.bmp" fileSizeLimit="300000" dataType="Text" tempFileFolder="TEMP" name="archivo" wizardTheme="Inline" wizardThemeType="File" processedFileFolder="resultado" fieldSource="archivo" required="True" caption="Archivo adjunto" disallowedFileMasks="*.exe;*.php;*.pl;*.html;*.htm" PathID="resultadosarchivo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</FileUpload>
				<Hidden id="25" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="nom_valor_enviar" wizardTheme="Inline" wizardThemeType="File" PathID="resultadosnom_valor_enviar">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="7" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="resultado_id" fieldSource="resultado_id" required="False" caption="Id" wizardCaption="Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="resultadosresultado_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="9" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="test_id" fieldSource="test_id" required="False" caption="Test Id" wizardCaption="Test Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="resultadostest_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="8" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="s_peticion_id" fieldSource="peticion_id" required="False" caption="Peticion Id" wizardCaption="Peticion Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="resultadoss_peticion_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="10" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="muestra_id" fieldSource="muestra_id" required="False" caption="Muestra Id" wizardCaption="Muestra Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="resultadosmuestra_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="11" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="estado_id" fieldSource="estado_id" required="False" caption="Estado Id" wizardCaption="Estado Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" defaultValue="10" PathID="resultadosestado_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="13" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="fecha_creacion" fieldSource="fecha_creacion" required="False" caption="Fecha Creacion" wizardCaption="Fecha Creacion" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" defaultValue="GetFechaServer(server)" PathID="resultadosfecha_creacion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="15" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="hora_creacion" fieldSource="hora_creacion" required="False" caption="Hora Creacion" wizardCaption="Hora Creacion" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" defaultValue="GetFechaServer('server_hora')" PathID="resultadoshora_creacion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="22" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="ingresado_por" fieldSource="ingresado_por" required="False" caption="Ingresado Por" wizardCaption="Ingresado Por" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" defaultValue="CCGetUserId()" PathID="resultadosingresado_por">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="27" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="pagina" wizardTheme="Inline" wizardThemeType="File" PathID="resultadospagina">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Agregar" PathID="resultadosButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Grabar" PathID="resultadosButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="5" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Cancelar" PathID="resultadosButton_Cancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events>
			</Events>
			<TableParameters>
				<TableParameter id="6" conditionType="Parameter" useIsNull="False" field="resultado_id" parameterSource="resultado_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="add_resultado_imagen.php" comment="//" codePage="utf-8" forShow="True" url="add_resultado_imagen.php"/>
		<CodeFile id="Events" language="PHPTemplates" name="add_resultado_imagen_events.php" forShow="False" comment="//" codePage="utf-8"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="29" groupID="5"/>
		<Group id="30" groupID="11"/>
		<Group id="31" groupID="12"/>
		<Group id="32" groupID="13"/>
		<Group id="33" groupID="14"/>
		<Group id="34" groupID="15"/>
		<Group id="35" groupID="16"/>
		<Group id="36" groupID="17"/>
		<Group id="37" groupID="18"/>
		<Group id="38" groupID="19"/>
		<Group id="39" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="40"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
